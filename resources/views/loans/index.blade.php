<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Daftar Peminjaman Buku</title>
    <style>
        body { font-family: sans-serif; margin: 40px; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { border: 1px solid #ddd; padding: 8px; text-align: left; }
        th { background-color: #f4f4f4; }
        .btn { padding: 6px 12px; background: #2563eb; color: #fff; text-decoration: none; border-radius: 4px; }
        .alert { padding: 10px; background: #d1fae5; color: #065f46; margin-bottom: 15px; border-radius: 4px; }
        .badge-active { background: #fef3c7; color: #d97706; padding: 3px 8px; border-radius: 4px; font-size: 12px; }
        .badge-returned { background: #d1fae5; color: #065f46; padding: 3px 8px; border-radius: 4px; font-size: 12px; }
    </style>
</head>
<body>
    <h1>Daftar Peminjaman Buku</h1>
    <p><a href="{{ route('loans.create') }}" class="btn">+ Tambah Peminjaman Baru</a></p>

    @if(session('success'))
        <div class="alert">{{ session('success') }}</div>
    @endif

    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Nama Anggota</th>
                <th>Buku yang Dipinjam</th>
                <th>Tanggal Pinjam</th>
                <th>Tanggal Kembali</th>
                <th>Status</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse($loans as $index => $loan)
                <tr>
                    <td>{{ $loans->firstItem() + $index }}</td>
                    <td>{{ $loan->member->nama ?? '-' }}</td>
                    <td>
                        <ul>
                            @foreach($loan->loanItems as $item)
                                <li>{{ $item->book->judul ?? '-' }}</li>
                            @endforeach
                        </ul>
                    </td>
                    <td>{{ $loan->tanggal_pinjam }}</td>
                    <td>{{ $loan->tanggal_kembali }}</td>
                    <td>
    @if ($loan['status'] === 'dipinjam')
        <span class="badge badge-warning">Dipinjam</span>
    @elseif ($loan['status'] === 'dikembalikan')
        <span class="badge badge-success">Dikembalikan</span>
    @else
        <span class="badge badge-danger">Terlambat</span>
    @endif
</td>
<td>
    <a href="{{ route('loans.show', $loan['id']) }}">Detail</a>
    |
    <a href="{{ route('loans.edit', $loan['id']) }}">Edit</a>
    
    @if ($loan['status'] === 'dipinjam')
        |
        <form class="inline" action="{{ route('loans.kembalikan', $loan['id']) }}" method="POST">
            @csrf
            @method('PATCH')
            <button type="submit" onclick="return confirm('Kembalikan buku ini?')">Kembalikan</button>
        </form>
    @endif

    |
    <form class="inline" action="{{ route('loans.destroy', $loan['id']) }}" method="POST">
        @csrf
        @method('DELETE')
        <button type="submit" onclick="return confirm('Hapus data ini?')">Hapus</button>
    </form>
</td>
                </tr>
            @empty
                <tr>
                    <td colspan="7" style="text-align: center;">Belum ada data peminjaman.</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <div style="margin-top: 20px;">
        {{ $loans->links() }}
    </div>
</body>
</html>