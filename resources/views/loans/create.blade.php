<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Tambah Peminjaman</title>
    <style>
        body { font-family: sans-serif; margin: 40px; max-width: 600px; }
        label { display: block; margin-top: 12px; font-weight: bold; }
        input, select { width: 100%; padding: 6px; margin-top: 4px; box-sizing: border-box; }
        .error { color: #b91c1c; font-size: 14px; margin-top: 4px; }
        .btn { margin-top: 20px; padding: 8px 16px; background: #2563eb; color: #fff; border: none; border-radius: 4px; cursor: pointer; }
        .checkbox-group { margin-top: 6px; max-height: 150px; overflow-y: auto; border: 1px solid #ddd; padding: 8px; }
    </style>
</head>
<body>
    <h1>Catat Peminjaman Buku Baru</h1>
    <p><a href="{{ route('loans.index') }}">&larr; Kembali ke daftar peminjaman</a></p>

    @if($errors->any())
        <div style="background: #fee2e2; color: #b91c1c; padding: 10px; border-radius: 4px; margin-bottom: 15px;">
            {{ $errors->first() }}
        </div>
    @endif

    <form action="{{ route('loans.store') }}" method="POST">
        @csrf

        <label for="member_id">Pilih Anggota</label>
        <select name="member_id" id="member_id">
            <option value="">-- Pilih Anggota --</option>
            @foreach($members as $member)
                <option value="{{ $member->id }}" {{ old('member_id') == $member->id ? 'selected' : '' }}>
                    {{ $member->nama }} (NIM: {{ $member->nim }})
                </option>
            @endforeach
        </select>

        <label for="tanggal_pinjam">Tanggal Pinjam</label>
        <input type="date" name="tanggal_pinjam" id="tanggal_pinjam" value="{{ old('tanggal_pinjam', date('Y-m-d')) }}">

        <label for="tanggal_kembali">Tanggal Pengembalian</label>
        <input type="date" name="tanggal_kembali" id="tanggal_kembali" value="{{ old('tanggal_kembali') }}">

        <label>Pilih Buku (Stok Tersedia)</label>
        <div class="checkbox-group">
            @foreach($books as $book)
                <div>
                    <label style="font-weight: normal;">
                        <input type="checkbox" name="books[]" value="{{ $book->id }}">
                        {{ $book->judul }} (Stok: {{ $book->stok }})
                    </label>
                </div>
            @endforeach
        </div>

        <button type="submit" class="btn">Simpan Peminjaman</button>
    </form>
</body>
</html>