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
        
        @media print {
            body {
                background-color: #fff;
            }
            .receipt-container {
                width: 100%;
                margin: 0;
                padding: 0;
                box-shadow: none;
            }
            @page {
                margin: 0;
            }
        }
    </style>
</head>
<body onload="window.print()">
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
