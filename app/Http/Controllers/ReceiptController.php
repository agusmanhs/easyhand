<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Transaction;

class ReceiptController extends Controller
{
    public function show($ref_id)
    {
        $transaction = Transaction::with(['user', 'product'])->where('ref_id', $ref_id)->firstOrFail();
        
        return view('receipt', compact('transaction'));
    }
}
