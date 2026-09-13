<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Daftar Buku</title>
    <style>
        body { font-family: sans-serif; margin: 40px; }
        table { border-collapse: collapse; width: 100%; margin-top: 16px; }
        th, td { border: 1px solid #ccc; padding: 8px 12px; text-align: left; }
        .success { background: #d1fae5; color: #065f46; padding: 10px 14px; border-radius: 4px; margin-top: 16px; }
        .btn { display: inline-block; padding: 6px 14px; background: #2563eb; color: #fff; text-decoration: none; border-radius: 4px; }
        form.inline { display: inline; }
    </style>
</head>
<body>
    <h1>Daftar Buku</h1>

    @if (session('success'))
        <div class="success">{{ session('success') }}</div>
    @endif

    <p><a href="{{ route('books.create') }}" class="btn">+ Tambah Buku</a></p>

    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Judul</th>
                <th>Penulis</th>
                <th>Penerbit</th>
                <th>Tahun</th>
                <th>Stok</th>
                <th>Kategori</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($books as $book)
                <tr>
                    <td>{{ $book['id'] }}</td>
                    <td>{{ $book['judul'] }}</td>
                    <td>{{ $book['penulis'] }}</td>
                    <td>{{ $book['penerbit'] }}</td>
                    <td>{{ $book['tahun_terbit'] }}</td>
                    <td>{{ $book['stok'] }}</td>
                    <td>{{ $book['kategori'] }}</td>
                    <td>
                        <a href="{{ route('books.show', $book['id']) }}">Detail</a>
                        |
                        <a href="{{ route('books.edit', $book['id']) }}">Edit</a>
                        |
                        <form class="inline" action="{{ route('books.destroy', $book['id']) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit">Hapus</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="8">Belum ada data buku.</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <p><em>Catatan: data di atas masih data dummy (array statis di Controller), belum dari database. Migration &amp; Model Eloquent baru dibuat di Pertemuan 5.</em></p>
</body>
</html>