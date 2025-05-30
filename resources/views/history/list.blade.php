<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order History - Dimsum Date</title>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;700&family=Poppins:wght@300;400;500&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset("../assets/css/dimsum.css") }}">
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
        }

        .history-container {
            max-width: 800px;
            margin: 6rem auto;
            padding: 0 1rem;
        }

        .order-card {
            background: white;
            border-radius: 10px;
            padding: 1.5rem;
            margin-bottom: 1rem;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
            cursor: pointer;
            transition: transform 0.2s;
        }

        .order-card:hover {
            transform: translateY(-2px);
        }

        .order-items {
            margin: 1rem 0;
        }

        .order-item {
            display: flex;
            justify-content: space-between;
            margin: 0.5rem 0;
            color: #333;
        }

        .order-total {
            display: flex;
            justify-content: flex-end;
            font-weight: 500;
            color: var(--primary-color);
            border-top: 1px solid #eee;
            padding-top: 1rem;
            margin-top: 1rem;
        }

        .order-status {
            display: inline-block;
            padding: 0.25rem 1rem;
            border-radius: 15px;
            font-size: 0.9rem;
            margin-top: 1rem;
        }

        .status-completed {
            background-color: #e8f5e9;
            color: #2e7d32;
        }

        .status-pending {
            background-color: #fff3e0;
            color: #ef6c00;
        }
    </style>
</head>
<body>
    <nav class="navbar" id="navbar">
        <div class="container">
            <div class="navbar-brand">
                <a href="../#home">
                    <img src="/assets/img/logo-dimsum.svg" alt="Dimsum Date" class="logo-img">
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

        <h2 class="history-title">Riwayat Pembelian</h2>

        <div class="order-card" onclick="window.location.href='/history/1'">
            <div class="order-items">
                <div class="order-item">
                    <span>Dimsum Ayam</span>
                    <div>
                        <span>x1</span>
                        <span style="margin-left: 2rem">Rp.xx.xx.x</span>
                    </div>
                </div>
                <div class="order-item">
                    <span>Dimsum Udang</span>
                    <div>
                        <span>x2</span>
                        <span style="margin-left: 2rem">Rp.xx.xx.x</span>
                    </div>
                </div>
            </div>
            <div class="order-total">Rp.xx.xx.x</div>
            <div class="order-status status-completed">Selesai</div>
        </div>

        <div class="order-card" onclick="window.location.href='/history/2'">
            <div class="order-items">
                <div class="order-item">
                    <span>Dimsum Ayam</span>
                    <div>
                        <span>x1</span>
                        <span style="margin-left: 2rem">Rp.xx.xx.x</span>
                    </div>
                </div>
                <div class="order-item">
                    <span>Dimsum Udang</span>
                    <div>
                        <span>x2</span>
                        <span style="margin-left: 2rem">Rp.xx.xx.x</span>
                    </div>
                </div>
                <div class="order-item">
                    <span>Es Teh</span>
                    <div>
                        <span>x2</span>
                        <span style="margin-left: 2rem">Rp.xx.xx.x</span>
                    </div>
                </div>
            </div>
            <div class="order-total">Rp.xx.xx.x</div>
            <div class="order-status status-completed">Selesai</div>
        </div>

        <div class="order-card" onclick="window.location.href='/history/3'">
            <div class="order-items">
                <div class="order-item">
                    <span>Dimsum Ayam</span>
                    <div>
                        <span>x1</span>
                        <span style="margin-left: 2rem">Rp.xx.xx.x</span>
                    </div>
                </div>
                <div class="order-item">
                    <span>Dimsum Udang</span>
                    <div>
                        <span>x2</span>
                        <span style="margin-left: 2rem">Rp.xx.xx.x</span>
                    </div>
                </div>
            </div>
            <div class="order-total">Rp.xx.xx.x</div>
            <div class="order-status status-completed">Selesai</div>
        </div>
    </div>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</body>
</html>
