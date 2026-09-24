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
                        @if($loan->status == 'dipinjam')
                            <span class="badge-active">Dipinjam</span>
                        @else
                            <span class="badge-returned">Dikembalikan</span>
                        @endif
                    </td>
                    <td>
                        @if($loan->status == 'dipinjam')
                            <form action="{{ route('loans.updateStatus', $loan->id) }}" method="POST" style="display:inline;" onsubmit="return confirm('Ubah status menjadi dikembalikan?')">
                                @csrf
                                @method('PATCH')
                                <button type="submit" style="background: #10b981; color: white; border: none; padding: 4px 8px; cursor: pointer; border-radius: 3px;">Kembalikan</button>
                            </form>
                        @endif
                        <form action="{{ route('loans.destroy', $loan->id) }}" method="POST" style="display:inline;" onsubmit="return confirm('Yakin ingin menghapus data ini?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" style="color: red; background: none; border: none; cursor: pointer;">Hapus</button>
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