<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;
use App\Models\Transaction;
use App\Models\Setting;
use App\Services\TelegramService;

class DigiflazzCallbackController extends Controller
{
    public function handle(Request $request)
    {
        $payload = $request->getContent();
        
        // 1. Verifikasi Signature (Jika Secret di-set)
        $secret = Setting::where('key', 'digiflazz_webhook_secret')->value('value');
        if ($secret) {
            $signature = 'sha1=' . hash_hmac('sha1', $payload, $secret);
            $headerSignature = $request->header('X-Hub-Signature', '');
            
            if (!hash_equals($signature, $headerSignature)) {
                Log::warning('Digiflazz Webhook: Invalid Signature', ['header' => $headerSignature]);
                return response()->json(['error' => 'Invalid signature'], 401);
            }
        }
        
        $data = $request->json('data');
        if (!$data || !isset($data['ref_id'])) {
            return response()->json(['error' => 'Invalid payload format'], 400);
        }
        
        $refId = $data['ref_id'];
        $status = $data['status'] ?? '';
        $message = $data['message'] ?? '';
        $sn = $data['sn'] ?? '';
        $rc = $data['rc'] ?? '';
        
        DB::beginTransaction();
        try {
            $transaction = Transaction::where('ref_id', $refId)->lockForUpdate()->first();
            
            if (!$transaction) {
                DB::rollBack();
                return response()->json(['error' => 'Transaction not found'], 404);
            }
            
            // Jika transaksi sudah final (Sukses/Gagal), jangan diproses ulang
            if (in_array(strtolower($transaction->status), ['sukses', 'gagal'])) {
                DB::rollBack();
                return response()->json(['message' => 'Transaction already final']);
            }
            
            $oldStatus = $transaction->status;
            
            // 2. Pembaruan Transaksi
            $transaction->status = $status;
            $transaction->message = $message;
            $transaction->sn = $sn;
            $transaction->rc = $rc;
            $transaction->save();
            
            // 3. Auto-Refund jika Gagal
            if (strtolower($status) === 'gagal') {
                $user = $transaction->user;
                $user->saldo = $user->saldo + $transaction->amount;
                $user->save();
                Log::info("Digiflazz Webhook: Auto-refund processed for ref_id {$refId}");
            }
            
            DB::commit();
            
            // 4. Notifikasi Telegram
            try {
                $notifMsg = "<b>🔔 Update Transaksi (Callback)</b>\n\n"
                     . "<b>Member:</b> {$transaction->user->name}\n"
                     . "<b>Produk:</b> {$transaction->buyer_sku_code}\n"
                     . "<b>Tujuan:</b> {$transaction->customer_no}\n"
                     . "<b>Status Awal:</b> " . strtoupper($oldStatus) . "\n"
                     . "<b>Status Baru:</b> " . strtoupper($status) . "\n"
                     . "<b>SN/Pesan:</b> {$sn} - {$message}";
                
                if (strtolower($status) === 'gagal') {
                    $notifMsg .= "\n<b>Info:</b> Saldo Rp " . number_format($transaction->amount, 0, ',', '.') . " telah di-refund ke user.";
                }
                
                TelegramService::sendToGroup($notifMsg);
            } catch (\Exception $e) {
                Log::error('Gagal kirim notif telegram callback: ' . $e->getMessage());
            }
            
            return response()->json(['message' => 'Callback processed successfully']);
            
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Digiflazz Webhook Error: ' . $e->getMessage());
            return response()->json(['error' => 'Internal server error'], 500);
        }
    }
}
