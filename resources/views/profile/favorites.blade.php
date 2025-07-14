<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Menu Favorit Anda - Dimsum Date</title>
    <link rel="icon" href="{{ asset('assets/img/logo-dimsum.svg') }}" type="image/svg">
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;700&family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" />
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #F8F9FA;
        }

        .page-container {
            max-width: 960px;
            margin: 8rem auto 4rem auto;
            padding: 0 1rem;
        }

        .page-header {
            text-align: center;
            margin-bottom: 2.5rem;
        }

        .page-header h1 {
            font-weight: 700;
            color: var(--primary-color);
            margin-bottom: 1.5rem;
            text-align: center;
        }

        .page-header p {
            color: #6c757d;
            font-size: 1.1rem;
        }

        .favorite-menu-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
            gap: 2rem;
        }

        .menu-item {
            background-color: #fff;
            border-radius: 12px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.05);
            border: 1px solid #E9ECEF;
            overflow: hidden;
            transition: opacity 0.4s ease, transform 0.4s ease, box-shadow 0.3s ease;
            display: flex;
            flex-direction: column;
        }
        .menu-item.fading-out {
            opacity: 0;
            transform: scale(0.95);
        }
        .menu-item:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.08);
        }

        .menu-image img {
            width: 100%;
            height: 200px;
            object-fit: cover;
        }

        .menu-content {
            padding: 1.25rem;
            flex-grow: 1;
            display: flex;
            flex-direction: column;
        }

        .menu-title-header {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            gap: 0.5rem;
            margin-bottom: 0.5rem;
        }

        .menu-title-header h3 {
            font-weight: 600;
            font-size: 1.2rem;
            color: #343A40;
            margin: 0;
            flex-grow: 1;
        }

        .menu-title-header .like-btn {
            background: none;
            border: none;
            padding: 0;
            cursor: pointer;
            color: #B22222;
            font-size: 1.3rem;
            line-height: 1;
        }

        .menu-content .price {
            font-size: 1.1rem;
            font-weight: 500;
            color: #B22222;
            margin-bottom: 1rem;
        }

        .menu-content .description {
            font-size: 0.9rem;
            color: #6C757D;
            line-height: 1.5;
            flex-grow: 1;
            margin-bottom: 1rem;
        }

        .empty-state {
            text-align: center;
            padding: 4rem 2rem;
            background-color: #fff;
            border-radius: 12px;
        }
        .empty-state i {
            font-size: 4rem;
            color: #B22222;
            margin-bottom: 1.5rem;
        }
        .empty-state p {
            font-size: 1.2rem;
            color: #6c757d;
            margin-bottom: 1.5rem;
        }
        .empty-state .btn-primary {
            background-color: #B22222;
            border-color: #B22222;
            color: #fff;
            padding: 0.75rem 1.5rem;
            text-decoration: none;
            border-radius: 8px;
            transition: background-color 0.3s;
        }
        .empty-state .btn-primary:hover {
            background-color: #9e1f1f;
        }
        @media screen and (max-width: 768px) {
            .page-container {
                padding: 0 1rem;
            }
            .page-header h1 {
                font-size: 2rem;
            }
            .menu-item {
                margin-bottom: 1.5rem;
            }
        }
    </style>
</head>
<body>
    <nav class="navbar scrolled">
        <div class="container">
            <div class="navbar-brand">
                <a href="{{ route('dashboard') }}">
                    <img src="{{ asset('assets/img/logo-dimsum.svg') }}" alt="Dimsum Date" class="logo-img">
                    <span>Dimsum Date</span>
                </a>
            </div>
        </div>
    </nav>

    <a href="{{ url()->previous() }}" class="back-button">
        <i class="fas fa-arrow-left"></i>
        <span class="back-text">Kembali</span>
    </a>

    <div class="page-container">
        <div class="page-header">
            <h1>Menu Favorit Anda</h1>
            <p>Koleksi hidangan yang paling Anda sukai.</p>
        </div>

        <div class="favorite-menu-grid" {{ $user->menuLikes->isEmpty() ? 'style="display: none;"' : '' }}>
            @foreach($user->menuLikes as $like)
                @php $menu = $like->menu; @endphp
                <div class="menu-item" data-id="{{ $menu->id }}">
                    <div class="menu-image">
                        @if ($menu->image_url && file_exists(public_path('assets/img/menu/' . $menu->image_url)))
                            <img src="{{ asset('assets/img/menu/' . $menu->image_url) }}" alt="{{ $menu->name }}">
                        @elseif ($menu->image_url && file_exists(storage_path('app/public/' . $menu->image_url)))
                            <img src="{{ asset('storage/' . $menu->image_url) }}" alt="{{ $menu->name }}">
                        @else
                            <img src="https://placehold.co/600x400/f1f1f1/b22222?text={{ urlencode($menu->name) }}" alt="{{ $menu->name }}">
                        @endif
                    </div>
                    <div class="menu-content">
                        <div class="menu-title-header">
                            <h3>{{ $menu->name }}</h3>
                            <button class="like-btn" data-menu-id="{{ $menu->id }}" title="Hapus dari favorit">
                                <i class="fas fa-heart"></i>
                            </button>
                        </div>
                        <p class="price">Rp {{ number_format($menu->price, 0, ',', '.') }}</p>
                        <p class="description">{{ Str::limit($menu->description, 100) }}</p>
                        <a href="{{ route('dashboard') }}#menu" class="btn btn-secondary" style="margin-top: auto;">Lihat di Menu</a>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
            const menuGrid = document.querySelector('.favorite-menu-grid');
            const emptyState = document.querySelector('.empty-state');

            document.querySelectorAll('.like-btn').forEach(button => {
                button.addEventListener('click', function() {
                    const menuId = this.dataset.menuId;
                    const card = this.closest('.menu-item');

                    fetch(`/menu/${menuId}/toggle-like`, {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': token
                        },
                    })
                    .then(response => {
                        if (!response.ok) {
                            throw new Error('Network response was not ok');
                        }
                        return response.json();
                    })
                    .then(data => {
                        if (data.is_liked === false) {
                            card.classList.add('fading-out');

                            setTimeout(() => {
                                card.remove();
                                // Cek apakah grid sekarang kosong
                                if (menuGrid.children.length === 0) {
                                    menuGrid.style.display = 'none';
                                    emptyState.style.display = 'block';
                                }
                            }, 400);
                        }
                    })
                    .catch(error => {
                        console.error('Error:', error);
                        alert('Terjadi kesalahan. Silakan coba lagi.');
                    });
                });
            });
        });
    </script>

</body>
</html>
