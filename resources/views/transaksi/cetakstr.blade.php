<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Struk Transaksi</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            font-family: "Courier New", monospace;
            background: #eaeaea;
            padding: 2rem;
        }

        .receipt {
            background: #fff;
            border-radius: 10px;
            box-shadow: 0 4px 15px rgba(0,0,0,0.1);
            max-width: 420px;
            margin: auto;
            padding: 1.8rem;
            border: 1px solid #ddd;
        }

        .receipt-header {
            text-align: center;
            margin-bottom: 1rem;
        }

        .receipt-header h3 {
            font-weight: bold;
            margin-bottom: 0.3rem;
            color: #2b2b2b;
            letter-spacing: 0.5px;
        }

        .receipt-header small {
            display: block;
            margin-bottom: 0.8rem;
            color: #555;
        }

        .divider {
            border-top: 2px dashed #bbb;
            margin: 10px 0;
        }

        .info-row {
            display: flex;
            justify-content: space-between;
            padding: 2px 0;
        }

        .info-row span:first-child {
            font-weight: 600;
            color: #333;
        }

        .total {
            border-top: 2px solid #000;
            border-bottom: 2px solid #000;
            text-align: right;
            font-size: 1.2rem;
            font-weight: bold;
            padding: 0.4rem 0;
            margin-top: 1rem;
        }

        .footer {
            text-align: center;
            font-size: 0.9rem;
            color: #666;
            margin-top: 1.5rem;
        }

        .footer b {
            color: #222;
        }

        .no-print {
            display: block;
            margin: 1rem auto 0;
        }

        @media print {
            .no-print { display: none; }
            body { background: #fff; padding: 0; margin: 0; }
            .receipt { box-shadow: none; border: none; margin: 0; }
        }
    </style>
</head>

<body>
<div class="receipt">

    <div class="receipt-header">
        <h3>Laundry Bersih &amp; Wangi</h3>
        <small>Jl. Galugung No. 8 – Tejo</small>
        <div class="divider"></div>
        <p class="mb-0 fw-bold">Struk Transaksi</p>
    </div>

    <div class="info">
        <div class="info-row"><span>Tanggal</span><span>{{ $transaksi->created_at->format('d-m-Y') }}</span></div>
        <div class="info-row"><span>Layanan</span><span>{{ $transaksi->layanan }}</span></div>
        <div class="info-row"><span>Berat</span><span>{{ $transaksi->berat }} kg</span></div>
        <div class="info-row"><span>Nama Pelanggan</span><span>{{ $transaksi->nama_pelanggan }}</span></div>
        <div class="info-row"><span>Keterangan</span><span>{{ $transaksi->keterangan }}</span></div>
    </div>

    <div class="total">
        Total: Rp{{ number_format($total_harga, 0, ',', '.') }}
    </div>

    <div class="footer">
        <p>Terima kasih telah menggunakan jasa kami 💧</p>
        <b>© Cendy Alviano SiLaundry 2025</b>
        <button class="btn btn-dark btn-sm no-print" onclick="window.print()">
            🖨 Cetak Struk
        </button>
    </div>
</div>
</body>
</html>