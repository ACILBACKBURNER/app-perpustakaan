<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Profil Saya - Perpustakaan Digital Kampus</title>
    <style>
        body { font-family: sans-serif; margin: 0; background: #f1f5f9; }
        .container { max-width: 600px; margin: 40px auto; background: #fff; padding: 32px; border-radius: 8px; box-shadow: 0 2px 8px rgba(0,0,0,.1); }
        h1 { font-size: 22px; margin-top: 0; }
        .alert-success { background: #d1fae5; color: #065f46; padding: 10px 14px; border-radius: 4px; margin-bottom: 16px; }
        .info-group { margin-bottom: 16px; }
        .info-group label { font-weight: bold; display: block; color: #64748b; font-size: 13px; }
        .info-group span { font-size: 16px; color: #1e293b; }
        hr { border: 0; border-top: 1px solid #e2e8f0; margin: 24px 0; }
        label { display: block; margin-top: 12px; font-weight: bold; font-size: 14px; }
        input { width: 100%; padding: 8px; margin-top: 4px; box-sizing: border-box; border: 1px solid #cbd5e1; border-radius: 4px; }
        .error { color: #b91c1c; font-size: 14px; margin-top: 4px; }
        .btn { margin-top: 20px; padding: 10px 16px; background: #2563eb; color: #fff; border: none; border-radius: 4px; cursor: pointer; font-size: 15px; }
        .btn:hover { background: #1d4ed8; }
        .back-link { display: inline-block; margin-bottom: 20px; color: #2563eb; text-decoration: none; }
        .back-link:hover { text-decoration: underline; }
    </style>
</head>
<body>
    <div class="container">
        <a href="{{ route('books.index') }}" class="back-link">&larr; Kembali ke Beranda</a>
        <h1>👤 Profil Pengguna</h1>

        @if (session('success'))
            <div class="alert-success">{{ session('success') }}</div>
        @endif

        <div class="info-group">
            <label>Nama Lengkap</label>
            <span>{{ $user->name }}</span>
        </div>

        <div class="info-group">
            <label>Email</label>
            <span>{{ $user->email }}</span>
        </div>

        <div class="info-group">
            <label>Role / Hak Akses</label>
            <span>{{ ucfirst($user->role) }}</span>
        </div>

        <hr>

        <h2>🔒 Ganti Password</h2>
        <form action="{{ route('profile.password.update') }}" method="POST">
            @csrf
            @method('PUT')

            <label for="current_password">Password Lama</label>
            <input type="password" name="current_password" id="current_password">
            @error('current_password')
                <div class="error">{{ $message }}</div>
            @enderror

            <label for="new_password">Password Baru (Minimal 8 karakter)</label>
            <input type="password" name="new_password" id="new_password">
            @error('new_password')
                <div class="error">{{ $message }}</div>
            @enderror

            <label for="new_password_confirmation">Konfirmasi Password Baru</label>
            <input type="password" name="new_password_confirmation" id="new_password_confirmation">

            <button type="submit" class="btn">Perbarui Password</button>
        </form>
    </div>
</body>
</html>