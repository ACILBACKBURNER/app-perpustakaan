<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Edit Kategori</title>
    <style>
        body { font-family: sans-serif; margin: 40px; max-width: 500px; }
        label { display: block; margin-top: 12px; font-weight: bold; }
        input, textarea { width: 100%; padding: 6px; margin-top: 4px; box-sizing: border-box; }
        .error { color: #b91c1c; font-size: 14px; margin-top: 4px; }
        .btn { margin-top: 20px; padding: 8px 16px; background: #2563eb; color: #fff; border: none; border-radius: 4px; cursor: pointer; }
    </style>
</head>
<body>
    <h1>Edit Kategori</h1>
    <p><a href="{{ route('categories.index') }}">&larr; Kembali ke daftar kategori</a></p>

    <form action="{{ route('categories.update', $category['id']) }}" method="POST">
        @csrf
        @method('PUT')

        <label for="nama_kategori">Nama Kategori</label>
        <input type="text" name="nama_kategori" id="nama_kategori" value="{{ old('nama_kategori', $category['nama_kategori']) }}">
        @error('nama_kategori')
            <div class="error">{{ $message }}</div>
        @enderror

        <label for="deskripsi">Deskripsi (opsional)</label>
        <textarea name="deskripsi" id="deskripsi" rows="4">{{ old('deskripsi', $category['deskripsi']) }}</textarea>
        @error('deskripsi')
            <div class="error">{{ $message }}</div>
        @enderror

        <button type="submit" class="btn">Perbarui</button>
    </form>
</body>
</html>