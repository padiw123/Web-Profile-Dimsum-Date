<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Pesanan #{{ $order->id }} - Dimsum Date</title>
    <link rel="icon" href="/assets/img/logo-dimsum.svg" type="image/svg">
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;700&family=Poppins:wght@300;400;500&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        :root {
            --primary-color: #B22222;
            --secondary-color: #D4AF37;
        }
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #f9fafb;
        }
        .detail-container {
            max-width: 800px;
            margin: 4rem auto;
            padding: 0 1rem;
        }
        .order-detail-card {
            background: white;
            border-radius: 12px;
            padding: 2rem;
            box-shadow: 0 4px 15px rgba(0,0,0,0.08);
        }
        .history-title {
            font-family: 'Playfair Display', serif;
            font-weight: 700;
            color: var(--primary-color);
            margin-bottom: 1.5rem;
            text-align: center;
        }

        .order-items { margin-bottom: 2rem; }
        .order-item {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 1rem 0;
            border-bottom: 1px solid #f0f0f0;
        }
        .order-item:last-child { border-bottom: none; }
        .order-info { margin-top: 1.5rem; }
        .order-info-row {
            display: flex;
            justify-content: space-between;
            margin-bottom: 0.75rem;
        }
        .order-info-row span:first-child { color: #666; }
        .order-info-row span:last-child { font-weight: 500; color: #333; }
        .total-row {
            font-size: 1.2rem;
            font-weight: 700;
            margin-top: 1.5rem;
            padding-top: 1.5rem;
            border-top: 2px solid #333;
        }
        .total-row span:last-child { color: var(--primary-color); }

        .order-header-details {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding-bottom: 1rem;
            margin-bottom: 1rem;
            border-bottom: 1px solid #eee;
        }
        .detail-status {
            padding: 0.3rem 0.8rem;
            border-radius: 20px;
            font-weight: 500;
            font-size: 0.9rem;
            color: white;
            text-transform: capitalize;
        }
        .status-completed { background-color: #198754; }
        .status-confirmed { background-color: #0d6efd; }
        .status-pending { background-color: #ffc107; color: #333;}
        .status-cancelled { background-color: #dc3545; }

        .order-service-type {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            font-size: 0.9rem;
            font-weight: 500;
            color: #555;
        }
        .order-service-type .fa-utensils { color: #0d6efd; }
        .order-service-type .fa-shopping-bag { color: #198754; }

        .order-notes {
            margin-top: 1.5rem;
            padding: 1rem;
            background-color: #f9f9f9;
            border-radius: 8px;
            border-left: 4px solid var(--secondary-color);
        }
        .order-notes h4 { margin-bottom: 0.5rem; color: #333; }
        .order-notes p { color: #666; white-space: pre-wrap; }

        .order-info .discount-row span:first-child {
            color: #2e7d32; /* Warna hijau untuk label diskon */
            font-weight: 600;
        }
        .order-info .discount-row span:last-child {
            color: #2e7d32;
            font-weight: 700;
        }
        .order-info .subtotal-row span:first-child {
            color: #666;
            font-weight: 500;
        }
        .order-info .subtotal-row span:last-child {
            color: #333;
            font-weight: 500;
        }

        @media (max-width: 768px) {
            .detail-container {
                margin: 6rem auto;
            }

            .order-detail-card {
                padding: 1.5rem;
            }

            .history-title {
                font-size: 1.8rem;
                margin: 2rem 2rem 2rem 2rem;
            }

            .order-header-details {
                flex-direction: column;
                align-items: flex-start;
                gap: 0.75rem;
            }

            .order-item span,
            .order-info-row span {
                font-size: 0.95rem;
            }

            .total-row {
                font-size: 1.1rem;
                margin-top: 1rem;
                padding-top: 1rem;
            }
        }

        @media (max-width: 480px) {
            .order-detail-card {
                padding: 1rem;
            }

            .history-title {
                font-size: 1.6rem;
                margin: 6rem 1.5rem 1.5rem 2rem;
            }

            .order-item span,
            .order-info-row span {
                font-size: 0.9rem;
            }
        }
    </style>
</head>
<body>
    <nav class="navbar" id="navbar">
        <div class="container">
            <div class="navbar-brand">
                <a href="{{ url('/') }}">
                    <img src="{{ asset('assets/img/logo-dimsum.svg') }}" alt="Dimsum Date" class="logo-img">
                    <span>Dimsum Date</span>
                </a>
            </div>
        </div>
    </nav>

    <div class="detail-container">
        <a href="{{ url()->previous() }}" class="back-button">
            <i class="fas fa-arrow-left"></i>
            <span class="back-text">Kembali</span>
        </a>

        <h2 class="history-title">Detail Pesanan #{{ $order->id }}</h2>

        <div class="order-detail-card">

            <div class="order-header-details">
                <div class="order-service-type">
                    @if ($order->service_type == 'dine_in')
                        <i class="fas fa-utensils"></i>
                        <span>Dine In</span>
                    @else
                        <i class="fas fa-shopping-bag"></i>
                        <span>Take Away</span>
                    @endif
                </div>
                <span class="detail-status status-{{ $order->status }}">
                    {{ str_replace('_', ' ', $order->status) }}
                </span>
            </div>

            <div class="order-items">
                @forelse($order->menus as $menu)
                <div class="order-item">
                    <span>{{ $menu->name }} <small> (x{{ $menu->pivot->quantity }})</small></span>
                    <span>Rp {{ number_format($menu->pivot->price * $menu->pivot->quantity, 0, ',', '.') }}</span>
                </div>
                @empty
                <div class="order-item">
                    <span>Tidak ada detail item menu untuk pesanan ini.</span>
                </div>
                @endforelse
            </div>

            @if($order->notes)
            <div class="order-notes">
                <h4>Catatan Pesanan:</h4>
                <p>{!! nl2br(e($order->notes)) !!}</p>
            </div>
            @endif

            <div class="order-info">
                <div class="order-info-row">
                    <span>Tanggal Pesan</span>
                    <span>{{ $order->created_at->translatedFormat('l, d F Y') }}</span>
                </div>
                <div class="order-info-row">
                    <span>Metode Pembayaran</span>
                    <span>{{ strtoupper($order->payment_method) }}</span>
                </div>
                @if($order->promo_id && $order->discount_amount > 0)
                    <div class="order-info-row subtotal-row" style="margin-top: 1rem; border-top: 1px dashed #ccc; padding-top: 1rem;">
                        <span>Subtotal</span>
                        <span>Rp {{ number_format($order->total_price + $order->discount_amount, 0, ',', '.') }}</span>
                    </div>
                    <div class="order-info-row discount-row">
                        <span>Diskon ({{ $order->promo->title ?? 'Promo' }})</span>
                        <span>- Rp {{ number_format($order->discount_amount, 0, ',', '.') }}</span>
                    </div>
                @endif
                <div class="order-info-row total-row">
                    <span>Total</span>
                    <span>Rp {{ number_format($order->total_price, 0, ',', '.') }}</span>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
