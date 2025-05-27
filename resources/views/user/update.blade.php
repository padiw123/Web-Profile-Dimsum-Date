<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Profile - Dimsum Date</title>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;700&family=Poppins:wght@300;400;500&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('../assets/css/dimsum.css') }}">
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
            background-color: #ffffff;
            font-family: 'Poppins', sans-serif;
        }

        .profile-container {
            max-width: 900px;
            margin: 6rem auto;
            padding: 0 1rem;
        }

        .profile-card {
            background: #d9d9d9;
            border-radius: 10px;
            box-shadow: 0 4px 15px rgba(0,0,0,0.1);
            overflow: hidden;
        }

        .profile-header {
            padding: 1rem 1.5rem;
            display: flex;
            justify-content: space-between;
            align-items: center;
            border-bottom: 1px solid #e0e0e0;
        }

        .profile-header h2 {
            color: #333; /* Warna teks judul disesuaikan dengan gambar */
            font-family: 'Poppins', sans-serif;
            font-size: 1.25rem;
            font-weight: 600;
            margin: 0;
        }

        .profile-header .edit-icon {
            color: var(--dark-color);
            font-size: 1.2rem;
            cursor: pointer;
        }

        .profile-content {
            display: flex;
            gap: 2rem;
            padding: 2rem;
            align-items: stretch; /* Penting: Membuat kolom anak meregang sama tinggi */
            background-color: white;
            border-radius: 12px;
            border: 5px solid #D9D9D9;
        }

        .profile-image-section {
            display: flex;
            flex-direction: column;
            justify-content: space-between; /* Mendorong gambar ke atas, tombol ke bawah */
            align-items: center; /* Untuk konten di dalamnya jika tidak full width */
            flex-basis: 200px;
            flex-shrink: 0;
        }

        .profile-image {
            width: 250px;
            height: 250px;
            background: #d9d9d9;
            border-radius: 10px;
            overflow: hidden;
            position: relative;
            border: 1px solid #dee2e6;
            display: flex;
            justify-content: center;
            align-items: center;
            margin-bottom: 2rem; /* Beri jarak jika konten lain ada di antara gambar dan tombol */
        }

        .profile-image img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .profile-image .placeholder-icon {
            font-size: 10rem;
            color: #000000;
        }

        .profile-image-overlay {
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: rgba(0,0,0,0.4);
            display: flex;
            align-items: center;
            justify-content: center;
            opacity: 0;
            transition: opacity 0.3s;
            cursor: pointer;
            border-radius: 10px;
        }

        .profile-image:hover .profile-image-overlay {
            opacity: 1;
        }

        .profile-image-overlay i {
            color: white;
            font-size: 1.5rem;
        }

        .profile-form-section {
            flex: 1;
            display: flex;
            flex-direction: column;
        }

        .form-group {
            margin-bottom: 1rem;
        }

        .form-label {
            color: #666; /* Warna label disesuaikan dengan gambar */
            font-size: 0.8rem;
            font-weight: 400; /* Ketebalan disesuaikan */
            margin-bottom: 0.4rem;
            display: block;
        }

        .form-input {
            width: 100%;
            padding: 0.6rem 0.1rem;
            border: none;
            border-bottom: 1px solid #ddd; /* Garis bawah disesuaikan */
            font-size: 0.9rem;
            transition: border-color 0.3s;
            background-color: transparent;
            color: #333; /* Warna teks input disesuaikan */
        }

        .form-input:focus {
            outline: none;
            border-color: var(--primary-color);
        }

        .profile-image-section .save-btn { /* Target spesifik tombol save di kolom gambar */
            background-color: var(--primary-color);
            color: white;
            padding: 0.7rem 1.5rem; /* Padding disesuaikan */
            border: none;
            border-radius: 10px;
            cursor: pointer;
            font-size: 0.9rem;
            font-weight: 500;
            transition: background-color 0.3s;
            width: 80%; /* Tombol mengambil lebar penuh kolom gambar */
        }

        .profile-image-section .save-btn:hover {
            background-color: #8B0000;
        }

        @media (max-width: 768px) {
            .profile-content {
                flex-direction: column;
                align-items: center; /* Default kembali ke center untuk tumpukan */
            }
            .profile-image-section {
                flex-basis: auto;
                width: 100%;
                align-items: center;
                margin-bottom: 1.5rem;
                justify-content: flex-start; /* Di mobile, tombol tidak perlu di paling bawah section jika section pendek */
            }
             .profile-image-section .save-btn {
                margin-top: 1rem; /* Beri jarak dari gambar di mobile */
                width: 80%; /* Atau sesuai preferensi mobile */
            }
            .profile-form-section {
                width: 100%;
            }
        }
    </style>
</head>
<body>
    <nav class="navbar">
        <div class="container">
            <div class="navbar-brand">
                <a href="../#home">
                    <img src="/assets/img/logo-dimsum.svg" alt="Dimsum Date" class="logo-img">
                    <span>Dimsum Date</span>
                </a>
            </div>
        </div>
    </nav>

    <div class="profile-container">
        <div class="profile-card">
            <div class="profile-header">
                <h2>Profile</h2>
                <i class="fas fa-pencil-alt edit-icon"></i>
            </div>
            <div class="profile-content">
                <form action="{{ route('profile') }}" method="POST" enctype="multipart/form-data" style="display: contents;">
                    @csrf
                    @method('PUT')

                    <div class="profile-image-section">
                        <div class="profile-image">
                            <i class="fas fa-user placeholder-icon"></i>
                            <label for="profile_picture" class="profile-image-overlay">
                                <i class="fas fa-camera"></i>
                            </label>
                            <input type="file" id="profile_picture" name="profile_picture" style="display: none" accept="image/*">
                        </div>
                        <button type="submit" class="save-btn">Save</button> </div>

                    <div class="profile-form-section">
                        <div class="form-group">
                                <label class="form-label" for="name">Nama</label>
                                <input type="text" class="form-input" id="name" name="name" value="Nicho Prasetyo" required>
                            </div>

                            <div class="form-group">
                                <label class="form-label" for="address">Alamat</label>
                                <input type="text" class="form-input" id="address" name="address" value="Prambanan" required>
                            </div>

                            <div class="form-group">
                                <label class="form-label" for="phone">No. Hp</label>
                                <input type="tel" class="form-input" id="phone" name="phone" value="087654321" required>
                            </div>

                            <div class="form-group">
                                <label class="form-label" for="email">Email</label>
                                <input type="email" class="form-input" id="email" name="email" value="Nicho@gmail.com" required>
                            </div>
                        </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        const profilePictureInput = document.getElementById('profile_picture');
        const placeholderIcon = document.querySelector('.profile-image .placeholder-icon');
        let profileImagePreview = document.querySelector('.profile-image img#profileImagePreview');

        profilePictureInput.addEventListener('change', function(e) {
            if (e.target.files && e.target.files[0]) {
                const reader = new FileReader();
                reader.onload = function(event) {
                    if (!profileImagePreview) {
                        profileImagePreview = document.createElement('img');
                        profileImagePreview.id = 'profileImagePreview';
                        profileImagePreview.alt = "Profile Picture";
                        document.querySelector('.profile-image').insertBefore(profileImagePreview, placeholderIcon.nextSibling);
                    }
                    profileImagePreview.src = event.target.result;
                    profileImagePreview.style.display = 'block';
                    if (placeholderIcon) placeholderIcon.style.display = 'none';
                };
                reader.readAsDataURL(e.target.files[0]);
            } else {
                if (profileImagePreview) {
                    // Opsi: kembali ke placeholder jika batal
                    profileImagePreview.src = '';
                    profileImagePreview.style.display = 'none';
                    if (placeholderIcon) placeholderIcon.style.display = 'block';
                } else {
                    if (placeholderIcon) placeholderIcon.style.display = 'block';
                }
            }
        });

        const initialUserImage = ''; // Ganti dengan URL gambar jika ada
        if (initialUserImage && profileImagePreview) {
            profileImagePreview.src = initialUserImage;
            profileImagePreview.style.display = 'block';
            if (placeholderIcon) placeholderIcon.style.display = 'none';
        } else {
            if (profileImagePreview) profileImagePreview.style.display = 'none';
            if (placeholderIcon) placeholderIcon.style.display = 'block';
        }
    </script>
</body>
</html>
