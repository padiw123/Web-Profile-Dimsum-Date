@extends('welcome') <!-- jika kamu pakai layout -->

@section('content')
<section id="menu" class="menu">
    <div class="container">
        <div class="section-header">
            <h2>All Menu</h2>
            <p>All authentic dimsum options</p>
        </div>

        <div class="menu-categories">
            <!-- tombol filter tetap -->
        </div>

        <div class="menu-grid">
            @foreach ($menus as $menu)
                <div class="menu-item" data-category="{{ $menu->category }}">
                    <div class="menu-image">
                        <img src="{{ $menu->image_url }}" alt="{{ $menu->name }}">
                    </div>
                    <div class="menu-content">
                        <h3>{{ $menu->name }} <span class="price">${{ number_format($menu->price, 2) }}</span></h3>
                        <p>{{ $menu->description }}</p>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>
@endsection
