<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Loan;
use App\Models\Member;
use Illuminate\Http\Request;

class LoanController extends Controller
{
    /**
     * Menampilkan daftar transaksi peminjaman (dengan Eager Loading).
     */
    public function index()
    {
        $loans = Loan::with(['member', 'user', 'loanItems.book'])->paginate(10);
        return view('loans.index', compact('loans'));
    }

    /**
     * Menampilkan form untuk membuat peminjaman baru.
     */
    public function create()
    {
        $members = Member::all();
        $books = Book::all();

        return view('loans.create', compact('members', 'books'));
    }

    /**
     * Menyimpan data peminjaman baru ke database.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'member_id' => 'required|integer|exists:members,id',
            'tanggal_pinjam' => 'required|date',
            'tanggal_kembali' => 'required|date|after_or_equal:tanggal_pinjam',
            'book_ids' => 'required|array|min:1',
            'book_ids.*' => 'integer|exists:books,id',
        ]);

        // Simpan transaksi loan dengan user_id otomatis dari akun yang sedang login
        $loan = Loan::create([
            'member_id' => $validated['member_id'],
            'user_id' => auth()->id(),
            'tanggal_pinjam' => $validated['tanggal_pinjam'],
            'tanggal_kembali' => $validated['tanggal_kembali'],
            'status' => 'dipinjam',
        ]);

        // Simpan item buku yang dipinjam ke tabel loan_items
        foreach ($validated['book_ids'] as $bookId) {
            $loan->loanItems()->create(['book_id' => $bookId]);
        }

        return redirect()->route('loans.index')
            ->with('success', 'Transaksi peminjaman berhasil dibuat.');
    }

    /**
     * Menampilkan detail transaksi peminjaman tertentu.
     */
    public function show(string $id)
    {
        $loan = Loan::with(['member', 'user', 'loanItems.book'])->findOrFail($id);
        return view('loans.show', compact('loan'));
    }

    /**
     * Menampilkan form edit transaksi peminjaman.
     */
    public function edit(string $id)
    {
        $loan = Loan::with('loanItems')->findOrFail($id);
        $members = Member::all();
        $books = Book::all();

        return view('loans.edit', compact('loan', 'members', 'books'));
    }

    /**
     * Memperbarui data transaksi peminjaman.
     */
    public function update(Request $request, string $id)
    {
        $loan = Loan::findOrFail($id);

        $validated = $request->validate([
            'member_id' => 'required|integer|exists:members,id',
            'tanggal_pinjam' => 'required|date',
            'tanggal_kembali' => 'required|date|after_or_equal:tanggal_pinjam',
            'status' => 'required|in:dipinjam,dikembalikan,terlambat',
            'book_ids' => 'required|array|min:1',
            'book_ids.*' => 'integer|exists:books,id',
        ]);

        $loan->update([
            'member_id' => $validated['member_id'],
            'tanggal_pinjam' => $validated['tanggal_pinjam'],
            'tanggal_kembali' => $validated['tanggal_kembali'],
            'status' => $validated['status'],
        ]);

        // Sinkronisasi ulang item buku yang dipinjam
        $loan->loanItems()->delete();
        foreach ($validated['book_ids'] as $bookId) {
            $loan->loanItems()->create(['book_id' => $bookId]);
        }

        return redirect()->route('loans.index')
            ->with('success', 'Data peminjaman berhasil diperbarui.');
    }

    /**
     * Aksi khusus untuk mengubah status peminjaman menjadi "dikembalikan".
     */
    public function kembalikan(string $id)
    {
        $loan = Loan::findOrFail($id);
        $loan->update(['status' => 'dikembalikan']);

        return redirect()->route('loans.index')
            ->with('success', 'Buku berhasil dikembalikan.');
    }

    /**
     * Menghapus transaksi peminjaman secara aman dari database.
     */
    public function destroy(string $id)
    {
        $loan = Loan::findOrFail($id);

        // Hapus item relasi terlebih dahulu agar terhindar dari foreign key constraint error
        $loan->loanItems()->delete();
        $loan->delete();

        return redirect()->route('loans.index')
            ->with('success', 'Transaksi peminjaman berhasil dihapus.');
    }
}