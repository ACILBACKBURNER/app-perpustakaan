<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Detail Buku</title>
    <style>
        body { font-family: sans-serif; margin: 40px; max-width: 500px; }
        table { border-collapse: collapse; width: 100%; margin-top: 16px; }
        th, td { border: 1px solid #ccc; padding: 8px 12px; text-align: left; }
        th { width: 160px; background: #f3f4f6; }
    </style>
</head>
<body>
    <h1>Detail Buku</h1>
    <p><a href="{{ route('books.index') }}">&larr; Kembali ke daftar buku</a></p>

    <table>
        <tr>
            <th>Judul</th>
            <td>{{ $book['judul'] }}</td>
        </tr>
        <tr>
            <th>Penulis</th>
            <td>{{ $book['penulis'] }}</td>
        </tr>
        <tr>
            <th>Penerbit</th>
            <td>{{ $book['penerbit'] }}</td>
        </tr>
        <tr>
            <th>Tahun Terbit</th>
            <td>{{ $book['tahun_terbit'] }}</td>
        </tr>
        <tr>
            <th>ISBN</th>
            <td>{{ $book['isbn'] ?? '-' }}</td>
        </tr>
        <tr>
            <th>Stok</th>
            <td>{{ $book['stok'] }}</td>
        </tr>
        <tr>
            <th>Kategori</th>
            <td>{{ $book['kategori'] }}</td>
        </tr>
    </table>
</body>
</html>