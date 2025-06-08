<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Pesanan #{{ $order->id }} - Dimsum Date</title>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;700&family=Poppins:wght@300;400;500&display=swap" rel="stylesheet">
    {{-- Path CSS disesuaikan untuk helper `asset()` Laravel --}}
    <link rel="stylesheet" href="{{ asset("assets/css/dimsum.css") }}">
    <style>
        /* CSS yang Anda berikan diintegrasikan di sini */
        :root {
            --primary-color: #B22222;
            --secondary-color: #D4AF37;
            --dark-color: #121212;
            --light-color: #FFFFFF;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Poppins', sans-serif;
            background-color: #f5f5f5;
        }

        .detail-container {
            max-width: 800px;
            margin: 6rem auto;
            padding: 0 1rem;
        }

        .order-detail-card {
            background: white;
            border-radius: 10px;
            padding: 2rem;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }

        .order-items {
            margin: 1rem 0 2rem 0;
        }

        .order-item {
            display: flex;
            justify-content: space-between;
            margin: 1rem 0;
            color: #333;
            font-size: 1.1rem;
        }

        .order-info {
            margin-top: 2rem;
            padding-top: 2rem;
            border-top: 1px solid #eee;
        }

        .order-info-row {
            display: flex;
            justify-content: space-between;
            margin: 0.5rem 0;
            color: #000000;
        }

        .total-row {
            font-size: 1.2rem;
            font-weight: 500;
            margin-top: 1rem;
        }

        .history-title {
            font-family: 'Playfair Display', serif;
            font-weight: 700;
            color: var(--primary-color);
            margin-bottom: 1.5rem;
        }
    </style>
</head>
<body>
    <nav class="navbar" id="navbar">
        <div class="container">
            <div class="navbar-brand">
                {{-- Link ke halaman utama --}}
                <a href="{{ url('/') }}">
                    {{-- Path logo disesuaikan untuk helper `asset()` Laravel --}}
                    <img src="{{ asset('assets/img/logo-dimsum.svg') }}" alt="Dimsum Date" class="logo-img">
                    <span>Dimsum Date</span>
                </a>
            </div>
        </div>
    </nav>

    <div class="detail-container">
        <a href="javascript:history.back()" class="back-button">
            <i class="fas fa-arrow-left"></i>
            <span class="back-text">Kembali</span>
        </a>

        <h2 class="history-title">Detail Pesanan</h2>

        <div class="order-detail-card">
            <div class="order-items">
                @forelse($order->menus as $menu)
                <div class="order-item">
                    <span>{{ $menu->name }}</span>
                    <div>
                        <span>x{{ $menu->pivot->quantity }}</span>
                        <span style="margin-left: 2rem">Rp {{ number_format($menu->pivot->price * $menu->pivot->quantity, 0, ',', '.') }}</span>
                    </div>
                </div>
                @empty
                    <div class="order-item">
                        <span>Tidak ada detail item menu untuk pesanan ini.</span>
                    </div>
                @endforelse
                {{-- Akhir Perulangan --}}

            </div>

            <div class="order-info">
                <div class="order-info-row">
                    <span>{{ $order->created_at->format('d/m/Y') }}</span>
                    <span style="font-size:1.2rem; font-weight: 500; color: black; margin-right: 1.5rem;">Total</span>
                </div><hr width="100%" color="black" style="opacity: 0.2;">
                <div class="order-info-row total-row">
                    <span>Pembayaran : {{ strtoupper($order->payment_method) }}</span>
                    <span>Rp {{ number_format($order->total_price, 0, ',', '.') }}</span>
                </div>
            </div>
        </div>
    </div>

    {{-- Menambahkan Font Awesome untuk ikon --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</body>
</html>
