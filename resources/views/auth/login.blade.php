<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Login - Perpustakaan Digital Kampus</title>
    <style>
        body { font-family: sans-serif; margin: 0; background: #f1f5f9; display: flex; align-items: center; justify-content: center; min-height: 100vh; }
        .login-box { background: #fff; padding: 32px; border-radius: 8px; box-shadow: 0 2px 8px rgba(0,0,0,.1); width: 100%; max-width: 360px; }
        .login-box h1 { font-size: 20px; margin-top: 0; text-align: center; }
        label { display: block; margin-top: 12px; font-weight: bold; }
        input { width: 100%; padding: 8px; margin-top: 4px; box-sizing: border-box; }
        .error { color: #b91c1c; font-size: 14px; margin-top: 4px; }
        .alert-success { background: #d1fae5; color: #065f46; padding: 10px 14px; border-radius: 4px; margin-bottom: 16px; }
        .checkbox-row { display: flex; align-items: center; gap: 6px; margin-top: 12px; }
        .checkbox-row label { display: inline; margin-top: 0; font-weight: normal; }
        .btn { margin-top: 20px; width: 100%; padding: 10px; background: #2563eb; color: #fff; border: none; border-radius: 4px; cursor: pointer; font-size: 15px; }
    </style>
</head>
<body>
    <div class="login-box">
        <h1>📚 Login Perpustakaan</h1>

        @if (session('success'))
            <div class="alert-success">{{ session('success') }}</div>
        @endif

        <form action="{{ route('login') }}" method="POST">
            @csrf

            <label for="email">Email</label>
            <input type="email" name="email" id="email" value="{{ old('email') }}" autofocus>
            @error('email')
                <div class="error">{{ $message }}</div>
            @enderror

            <label for="password">Password</label>
            <input type="password" name="password" id="password">
            @error('password')
                <div class="error">{{ $message }}</div>
            @enderror

            <div class="checkbox-row">
                <input type="checkbox" name="remember" id="remember">
                <label for="remember">Ingat saya</label>
            </div>

            <button type="submit" class="btn">Login</button>
        </form>
    </div>
</body>
</html>