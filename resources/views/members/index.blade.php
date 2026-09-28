<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Daftar Anggota</title>
    <style>
        body { font-family: sans-serif; margin: 40px; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { border: 1px solid #ddd; padding: 8px; text-align: left; }
        th { background-color: #f4f4f4; }
        .btn { padding: 6px 12px; background: #2563eb; color: #fff; text-decoration: none; border-radius: 4px; }
        .alert { padding: 10px; background: #d1fae5; color: #065f46; margin-bottom: 15px; border-radius: 4px; }
    </style>
</head>
<body>
    <h1>Daftar Anggota Perpustakaan</h1>
    <p><a href="{{ route('members.create') }}" class="btn">+ Tambah Anggota</a></p>

    @if(session('success'))
        <div class="alert">{{ session('success') }}</div>
    @endif

    <table>
    <thead>
        <tr>
            <th>No</th>
            <th>Nama</th>
            <th>NIM</th>
            <th>Email</th>
            <th>Status</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($members as $index => $member)
            <tr>
                <td>{{ $members->firstItem() + $index }}</td>
                <td>{{ $member->nama }}</td>
                <td>{{ $member->nim }}</td>
                <td>{{ $member->email }}</td>
                <td>
                    @if ($member->status === 'aktif')
                        <span class="badge badge-success">Aktif</span>
                    @else
                        <span class="badge badge-danger">Nonaktif</span>
                    @endif
                </td>
                <td>
                    {{-- TAMBAHKAN LINK DETAIL INI --}}
                    <a href="{{ route('members.show', $member->id) }}">Detail</a>
                    |
                    <a href="{{ route('members.edit', $member->id) }}">Edit</a>
                    |
                    <form action="{{ route('members.destroy', $member->id) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" onclick="return confirm('Yakin ingin menghapus anggota ini?')">Hapus</button>
                    </form>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>

    <div style="margin-top: 20px;">
        {{ $members->links() }}
    </div>
</body>
</html>