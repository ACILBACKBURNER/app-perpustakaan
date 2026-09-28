<h3>Riwayat Peminjaman Buku</h3>

@if ($member->loans->isEmpty())
    <p>Anggota ini belum pernah meminjam buku.</p>
@else
    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Tanggal Pinjam</th>
                <th>Tanggal Kembali</th>
                <th>Status</th>
                <th>Petugas</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($member->loans as $index => $loan)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $loan->tanggal_pinjam }}</td>
                    <td>{{ $loan->tanggal_kembali }}</td>
                    <td>
                        @if ($loan->status === 'dipinjam')
                            <span class="badge badge-warning">Dipinjam</span>
                        @elseif ($loan->status === 'dikembalikan')
                            <span class="badge badge-success">Dikembalikan</span>
                        @else
                            <span class="badge badge-danger">Terlambat</span>
                        @endif
                    </td>
                    <td>{{ $loan->user->name ?? '-' }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endif