<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Struk Transaksi - {{ $transaction->ref_id }}</title>
    <style>
        body {
            font-family: 'Courier New', Courier, monospace;
            margin: 0;
            padding: 0;
            background-color: #f0f0f0;
        }
        .receipt-container {
            width: 300px;
            margin: 20px auto;
            background-color: #fff;
            padding: 15px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }
        .header {
            text-align: center;
            margin-bottom: 10px;
        }
        .store-name {
            font-size: 1.2em;
            font-weight: bold;
            margin: 5px 0;
        }
        .divider {
            border-top: 1px dashed #000;
            margin: 10px 0;
        }
        .detail-row {
            display: flex;
            justify-content: space-between;
            margin: 3px 0;
            font-size: 0.9em;
        }
        .detail-label {
            text-align: left;
            flex: 1;
        }
        .detail-value {
            text-align: right;
            font-weight: bold;
            flex: 1;
        }
        .footer {
            text-align: center;
            font-size: 0.8em;
            margin-top: 15px;
        }
        .status-badge {
            display: inline-block;
            padding: 3px 8px;
            border-radius: 3px;
            font-weight: bold;
            margin-top: 5px;
        }
        .status-success { border: 1px solid #000; }
        .status-pending { border: 1px dashed #000; }
        .status-failed { border: 1px solid #000; text-decoration: line-through; }
        
        /* Action Buttons Styling */
        .action-buttons {
            text-align: center;
            margin-bottom: 20px;
            padding: 10px;
            background-color: #fff;
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
        }
        .btn {
            display: inline-block;
            padding: 8px 12px;
            margin: 5px;
            border-radius: 4px;
            text-decoration: none;
            font-family: Arial, sans-serif;
            font-size: 14px;
            font-weight: bold;
            color: #fff;
            border: none;
            cursor: pointer;
        }
        .btn-blue { background-color: #007bff; }
        .btn-green { background-color: #28a745; }
        
        @media print {
            body { background-color: #fff; }
            .receipt-container {
                width: 100%;
                margin: 0;
                padding: 0;
                box-shadow: none;
            }
            .no-print { display: none !important; }
            @page { margin: 0; }
        }
    </style>
</head>
<body>
    @php
        // Persiapan teks mentah untuk RawBT
        $storeName = $transaction->user->store_name ?: 'Toko Anda';
        
        // Fungsi pembantu agar text rata kanan-kiri (Total 32 karakter untuk 58mm printer)
        $charLimit = 32;
        $rawText = "[C]" . $storeName . "\n";
        $rawText .= "[C]Struk Pembelian / Pembayaran\n";
        $rawText .= str_repeat("-", $charLimit) . "\n";
        $rawText .= "Tanggal: " . $transaction->created_at->format('d/m/Y H:i') . "\n";
        $rawText .= "Ref ID : " . $transaction->ref_id . "\n";
        $rawText .= str_repeat("-", $charLimit) . "\n";
        
        $produk = $transaction->product ? $transaction->product->product_name : $transaction->buyer_sku_code;
        $rawText .= "Produk : " . $produk . "\n";
        $rawText .= "Tujuan : " . $transaction->customer_no . "\n";
        $rawText .= str_repeat("-", $charLimit) . "\n";
        
        if($transaction->sn) {
            $rawText .= "[C]SN / Token:\n";
            $rawText .= "[C]" . $transaction->sn . "\n";
            $rawText .= str_repeat("-", $charLimit) . "\n";
        }
        
        $total = number_format($transaction->amount + ($transaction->user->store_markup ?? 0), 0, ',', '.');
        $rawText .= "[R]TOTAL: Rp " . $total . "\n\n";
        
        $rawText .= "[C]" . strtoupper($transaction->status) . "\n";
        $rawText .= "[C]Terima kasih telah berbelanja!\n";
        
        // RawBT mendukung tag seperti [C] untuk Center, [R] untuk Right, dll.
        $base64Text = base64_encode($rawText);
    @endphp

    <!-- Area Tombol Aksi (Tidak ikut terprint) -->
    <div class="action-buttons no-print">
        <div style="margin-bottom: 10px; font-family: Arial; font-size: 13px; color: #555;">Pilih metode cetak:</div>
        <a href="intent:base64,{{ $base64Text }}#Intent;scheme=rawbt;package=ru.a402d.rawbtprinter;S.browser_fallback_url=https%3A%2F%2Fplay.google.com%2Fstore%2Fapps%2Fdetails%3Fid%3Dru.a402d.rawbtprinter;end;" class="btn btn-green">
            🖨️ Cetak via Bluetooth (RawBT)
        </a>
        <button onclick="window.print()" class="btn btn-blue">
            📄 Cetak Standar Browser
        </button>
    </div>

    <!-- Area Struk yang akan diprint jika menggunakan standar browser -->
    <div class="receipt-container">
        <div class="header">
            <div class="store-name">{{ $transaction->user->store_name ?: 'Toko Anda' }}</div>
            <div style="font-size: 0.8em;">Struk Pembelian / Pembayaran</div>
        </div>

        <div class="divider"></div>

        <div class="detail-row">
            <span class="detail-label">Tanggal:</span>
            <span class="detail-value">{{ $transaction->created_at->format('d/m/Y H:i') }}</span>
        </div>
        <div class="detail-row">
            <span class="detail-label">Ref ID:</span>
            <span class="detail-value" style="font-size: 0.8em;">{{ $transaction->ref_id }}</span>
        </div>

        <div class="divider"></div>

        <div class="detail-row">
            <span class="detail-label">Produk:</span>
            <span class="detail-value">{{ $transaction->product ? $transaction->product->product_name : $transaction->buyer_sku_code }}</span>
        </div>
        <div class="detail-row">
            <span class="detail-label">Tujuan:</span>
            <span class="detail-value">{{ $transaction->customer_no }}</span>
        </div>

        <div class="divider"></div>
        
        @if($transaction->sn)
        <div style="text-align: center; margin: 10px 0;">
            <div style="font-size: 0.8em; margin-bottom: 2px;">SN / Token / Struk:</div>
            <div style="font-weight: bold; font-size: 1.1em; word-break: break-all;">
                {{ $transaction->sn }}
            </div>
        </div>
        <div class="divider"></div>
        @endif

        <div class="detail-row" style="font-size: 1.1em; margin-top: 10px;">
            <span class="detail-label">TOTAL:</span>
            <span class="detail-value">Rp {{ number_format($transaction->amount + ($transaction->user->store_markup ?? 0), 0, ',', '.') }}</span>
        </div>
        
        <div class="header" style="margin-top: 15px;">
            <span class="status-badge 
                {{ $transaction->status === 'Sukses' ? 'status-success' : ($transaction->status === 'Pending' ? 'status-pending' : 'status-failed') }}">
                {{ strtoupper($transaction->status) }}
            </span>
        </div>

        <div class="footer">
            Terima kasih telah berbelanja!<br>
            Simpan struk ini sebagai bukti pembayaran yang sah.
        </div>
    </div>
</body>
</html>
