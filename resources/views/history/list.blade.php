<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Riwayat Pesanan - Dimsum Date</title>
    <link rel="icon" href="/assets/img/logo-dimsum.svg" type="image/svg">
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;700&family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
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
            color: #333;
        }

        .history-container {
            max-width: 500px;
            margin: 0 auto;
            padding: 100px 20px 40px 20px;
        }

        .order-card-new {
            background-color: #e8e8e8;
            border-radius: 15px;
            margin-bottom: 1rem;
            overflow: hidden;
            cursor: pointer;
            transition: transform 0.2s ease;
        }

        .order-card-new:hover {
            transform: translateY(-2px);
        }

        .order-card-content {
            padding: 1.5rem;
        }

        .order-service-type {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            padding-bottom: 0.75rem;
            margin-bottom: 0.75rem;
            border-bottom: 1px solid #f0f0f0;
            font-size: 0.9rem;
            font-weight: 500;
            color: #555;
        }

        .order-service-type .fa-utensils {
            color: #0d6efd;
        }

        .order-service-type .fa-shopping-bag {
            color: #198754;
        }
        .order-items {
            margin-bottom: 1rem;
        }

        .order-item {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 0.5rem;
            font-size: 0.95rem;
        }

        .item-name {
            color: #333;
            font-weight: 400;
        }

        .item-details {
            display: flex;
            align-items: center;
            gap: 1rem;
            color: #333;
        }

        .item-quantity {
            font-size: 0.9rem;
        }

        .item-price {
            font-size: 0.9rem;
        }

        .order-total {
            text-align: right;
            font-size: 1.1rem;
            font-weight: 600;
            color: #333;
            margin-top: 1rem;
            padding-top: 1rem;
            border-top: 1px solid #ccc;
        }

        .order-status {
            text-align: center;
            padding: 0.8rem;
            background-color: #d0d0d0;
            color: #333;
            font-size: 0.9rem;
            font-weight: 500;
            text-transform: lowercase;
        }

        .status-completed {
            background-color: var(--success-color);
            color: var(--light-color);
        }

        .status-cancelled {
            background-color: var(--primary-color);
            color: var(--light-color);
        }
        .status-confirmed {
            background-color: var(--secondary-color);
            color: var(--light-color);
        }
        .status-pending {
            background-color: #333;
            color: var(--light-color);
        }
        .pagination {
            display: flex;
            justify-content: center;
            margin-top: 2rem;
        }
        @media (max-width: 600px) {
            .history-container {
                margin-top: 6rem;
                padding: 80px 15px 30px 15px;
            }

            .order-card-content {
                padding: 1rem;
            }

            .order-item {
                font-size: 0.9rem;
            }

            .item-details {
                gap: 0.75rem;
            }

            .order-total {
                font-size: 1rem;
            }

            .pagination {
                font-size: 0.9rem;
            }

            .pagination .page-item:first-child .page-link,
            .pagination .page-item:last-child .page-link {
                padding: 0.3rem 0.6rem;
            }

            .pagination .page-link {
                padding: 0.4rem 0.6rem;
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

    <div class="history-container">
        <a href="javascript:history.back()" class="back-button">
            <i class="fas fa-arrow-left"></i>
            <span class="back-text">Kembali</span>
        </a>
        @forelse ($orders as $order)
            @php
                $firstMenu = $order->menus->first();
                $totalItems = $order->menus->sum('pivot.quantity');
            @endphp

            <div class="order-card-new" onclick="window.location.href='{{ route('detailhistory', $order) }}'">
                <div class="order-card-content">
                    <div class="order-service-type">
                        @if ($order->service_type == 'dine_in')
                            <i class="fas fa-utensils"></i>
                            <span>Dine In</span>
                        @else
                            <i class="fas fa-shopping-bag"></i>
                            <span>Take Away</span>
                        @endif
                    </div>
                    <div class="order-items">
                        @foreach ($order->menus as $menu)
                            @if ($loop->index < 2)
                                <div class="order-item">
                                    <span class="item-name">{{ $menu->name }}</span>
                                    <div class="item-details">
                                        <span class="item-quantity">x{{ $menu->pivot->quantity }}</span>
                                        <span class="item-price">Rp {{ number_format($menu->pivot->price * $menu->pivot->quantity, 0, ',', '.') }}</span>
                                    </div>
                                </div>
                            @endif
                        @endforeach

                        @if ($order->menus->count() > 2)
                            <div class="order-item">
                                <span class="ellipsis-item">...</span>
                            </div>
                        @endif
                    </div>
                    <div class="order-total">Rp {{ number_format($order->total_price, 0, ',', '.') }}</div>
                </div>
                <div class="order-status status-{{ $order->status }}">
                    @switch($order->status)
                        @case('pending')
                            menunggu
                            @break
                        @case('confirmed')
                            dikonfirmasi
                            @break
                        @case('completed')
                            selesai
                            @break
                        @case('cancelled')
                            dibatalkan
                            @break
                        @default
                            {{ $order->status }}
                    @endswitch
                </div>
            </div>
        @empty
            <div class="no-history">
                <p>Anda belum memiliki riwayat pesanan.</p>
                <a href="{{ url('/#menu') }}" class="btn btn-primary">Mulai Belanja</a>
            </div>
        @endforelse

        @if(isset($orders) && method_exists($orders, 'links'))
            <div class="pagination">
                {{ $orders->links() }}
            </div>
        @endif
    </div>

</body>
</html>
