<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Loan;
use App\Models\Member;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class LoanController extends Controller
{
    public function index()
    {
        $loans = Loan::with(['member', 'loanItems.book'])->paginate(10);
        return view('loans.index', compact('loans'));
    }

    public function create()
    {
        $members = Member::where('status', 'aktif')->get();
        $books = Book::where('stok', '>', 0)->get();
        return view('loans.create', compact('members', 'books'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'member_id' => 'required|exists:members,id',
            'tanggal_pinjam' => 'required|date',
            'tanggal_kembali' => 'required|date|after_or_equal:tanggal_pinjam',
            'books' => 'required|array|min:1',
            'books.*' => 'exists:books,id',
        ]);

        try {
            DB::transaction(function () use ($request) {
                // Buat data peminjaman utama
                $loan = Loan::create([
                    'member_id' => $request->member_id,
                    'tanggal_pinjam' => $request->tanggal_pinjam,
                    'tanggal_kembali' => $request->tanggal_kembali,
                    'status' => 'dipinjam',
                ]);

                // Simpan buku yang dipinjam ke loan_items dan kurangi stok buku
                foreach ($request->books as $bookId) {
                    $book = Book::findOrFail($bookId);
                    
                    if ($book->stok < 1) {
                        throw new \Exception("Stok buku \"{$book->judul}\" habis.");
                    }

                    // Kurangi stok buku
                    $book->decrement('stok');

                    // Simpan ke detail peminjaman
                    $loan->loanItems()->create([
                        'book_id' => $book->id,
                        'jumlah' => 1,
                    ]);
                }
            });

            return redirect()->route('loans.index')
                ->with('success', 'Transaksi peminjaman berhasil dicatat.');

        } catch (\Exception $e) {
            return back()->withErrors(['error' => $e->getMessage()])->withInput();
        }
    }

    public function updateStatus(string $id)
    {
        try {
            DB::transaction(function () use ($id) {
                $loan = Loan::with('loanItems.book')->findOrFail($id);
                
                if ($loan->status == 'dipinjam') {
                    $loan->update(['status' => 'dikembalikan']);

                    // Kembalikan stok buku
                    foreach ($loan->loanItems as $item) {
                        $item->book->increment('stok', $item->jumlah);
                    }
                }
            });

            return redirect()->route('loans.index')
                ->with('success', 'Status peminjaman diubah menjadi dikembalikan, stok buku telah dipulihkan.');

        } catch (\Exception $e) {
            return back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    public function destroy(string $id)
    {
        $loan = Loan::findOrFail($id);
        
        if ($loan->status == 'dipinjam') {
            return back()->withErrors(['error' => 'Peminjaman yang masih aktif (belum dikembalikan) tidak dapat dihapus.']);
        }

        $loan->delete();
        return redirect()->route('loans.index')
            ->with('success', 'Data transaksi peminjaman berhasil dihapus.');
    }
}