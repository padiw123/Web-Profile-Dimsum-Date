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
        /* CSS Anda dari file sebelumnya sudah bagus dan saya pertahankan */
        :root { --primary-color: #B22222; --secondary-color: #D4AF37; --dark-color: #121212; --light-color: #FFFFFF; }
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { background-color: #ffffff; font-family: 'Poppins', sans-serif; }
        .profile-container { max-width: 900px; margin: 6rem auto; padding: 0 1rem; }
        .profile-card { background: #d9d9d9; border-radius: 10px; box-shadow: 0 4px 15px rgba(0,0,0,0.1); overflow: hidden; }
        .profile-header { padding: 1rem 1.5rem; display: flex; justify-content: space-between; align-items: center; border-bottom: 1px solid #e0e0e0; }
        .profile-header h2 { color: #333; font-family: 'Poppins', sans-serif; font-size: 1.25rem; font-weight: 600; margin: 0; }
        .profile-content { display: flex; gap: 2rem; padding: 2rem; align-items: flex-start; background-color: white; border-radius: 12px; border: 5px solid #D9D9D9; }
        .profile-image-section { display: flex; flex-direction: column; align-items: center; flex-basis: 250px; flex-shrink: 0; }
        .profile-image { width: 250px; height: 250px; background: #d9d9d9; border-radius: 10px; overflow: hidden; position: relative; border: 1px solid #dee2e6; display: flex; justify-content: center; align-items: center; margin-bottom: 1.5rem; }
        .profile-image img { width: 100%; height: 100%; object-fit: cover; }
        .profile-image .placeholder-icon { font-size: 10rem; color: #000000; }
        .profile-image-overlay { position: absolute; top: 0; left: 0; right: 0; bottom: 0; background: rgba(0,0,0,0.4); display: flex; align-items: center; justify-content: center; opacity: 0; transition: opacity 0.3s; cursor: pointer; border-radius: 10px; }
        .profile-image:hover .profile-image-overlay { opacity: 1; }
        .profile-image-overlay i { color: white; font-size: 1.5rem; }
        .profile-form-section { flex: 1; display: flex; flex-direction: column; }
        .form-group { margin-bottom: 1rem; }
        .form-label { color: #666; font-size: 0.8rem; font-weight: 400; margin-bottom: 0.4rem; display: block; }
        .form-input { width: 100%; padding: 0.6rem 0.1rem; border: none; border-bottom: 1px solid #ddd; font-size: 0.9rem; transition: border-color 0.3s; background-color: transparent; color: #333; }
        .form-input:focus { outline: none; border-color: var(--primary-color); }
        .save-btn { background-color: var(--primary-color); color: white; padding: 0.8rem 1.5rem; border: none; border-radius: 10px; cursor: pointer; font-size: 1rem; font-weight: 500; transition: background-color 0.3s; width: 80%; }
        .save-btn:hover { background-color: #8B0000; }
        /* Style untuk pesan error */
        .error-message { color: #B22222; font-size: 0.8rem; margin-top: 0.25rem; }
        @media (max-width: 768px) {
            .profile-content { flex-direction: column; align-items: center; }
            .profile-image-section { margin-bottom: 1.5rem; }
            .profile-form-section { width: 100%; }
        }
    </style>
</head>
<body>
    <nav class="navbar">
        <div class="container">
            <div class="navbar-brand">
                <a href="{{ url('/') }}">
                    <img src="{{ asset('/assets/img/logo-dimsum.svg') }}" alt="Dimsum Date" class="logo-img">
                    <span>Dimsum Date</span>
                </a>
            </div>
        </div>
    </nav>

    <div class="profile-container">
        <div class="profile-card">
            <div class="profile-header">
                <h2>Update Profile</h2>
            </div>

            <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="profile-content">
                    <div class="profile-image-section">
                        <div class="profile-image">
                            <img id="profileImagePreview"
                                 src="{{ $user->profile_photo_path ? asset('storage/' . $user->profile_photo_path) : '' }}"
                                 alt="Profile Preview"
                                 style="{{ $user->profile_photo_path ? '' : 'display:none;' }}">
                            <i class="fas fa-user placeholder-icon" style="{{ $user->profile_photo_path ? 'display:none;' : '' }}"></i>
                            <label for="profile_picture" class="profile-image-overlay">
                                <i class="fas fa-camera"></i>
                            </label>
                            <input type="file" id="profile_picture" name="profile_picture" style="display: none" accept="image/*">
                        </div>
                        {{-- Menampilkan error untuk profile_picture --}}
                        @error('profile_picture')
                            <p class="error-message">{{ $message }}</p>
                        @enderror
                        <button type="submit" class="save-btn">Save</button>
                    </div>

                    <div class="profile-form-section">
                        <div class="form-group">
                            <label class="form-label" for="name">Nama</label>
                            <input type="text" class="form-input" id="name" name="name" value="{{ old('name', $user->name) }}" required>
                            {{-- Menampilkan notifikasi error untuk 'name' --}}
                            @error('name')
                                <p class="error-message">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label class="form-label" for="address">Alamat</label>
                            <input type="text" class="form-input" id="address" name="address" value="{{ old('address', $user->address ?? '') }}" required>
                            {{-- Menampilkan notifikasi error untuk 'address' --}}
                            @error('address')
                                <p class="error-message">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label class="form-label" for="phone">No. Hp</label>
                            <input type="tel" class="form-input" id="phone" name="phone" value="{{ old('phone', $user->phone ?? '') }}" required>
                            {{-- Menampilkan notifikasi error untuk 'phone' --}}
                            @error('phone')
                                <p class="error-message">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label class="form-label" for="email">Email</label>
                            <input type="email" class="form-input" id="email" name="email" value="{{ old('email', $user->email) }}" required>
                            {{-- Menampilkan notifikasi error untuk 'email' --}}
                            @error('email')
                                <p class="error-message">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <script>
        const profilePictureInput = document.getElementById('profile_picture');
        const placeholderIcon = document.querySelector('.profile-image .placeholder-icon');
        const profileImagePreview = document.getElementById('profileImagePreview');

        profilePictureInput.addEventListener('change', function(e) {
            if (e.target.files && e.target.files[0]) {
                const reader = new FileReader();
                reader.onload = function(event) {
                    profileImagePreview.src = event.target.result;
                    profileImagePreview.style.display = 'block';
                    placeholderIcon.style.display = 'none';
                };
                reader.readAsDataURL(e.target.files[0]);
            }
        });
    </script>
</body>
</html>
