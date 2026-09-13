<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreBookRequest;
use Illuminate\Http\Request;

class BookController extends Controller
{
    private array $categories = [
        ['id' => 1, 'nama_kategori' => 'Fiksi'],
        ['id' => 2, 'nama_kategori' => 'Teknologi'],
        ['id' => 3, 'nama_kategori' => 'Sejarah'],
    ];

    private array $books = [
        [
            'id' => 1,
            'judul' => 'Laskar Pelangi',
            'penulis' => 'Andrea Hirata',
            'penerbit' => 'Bentang Pustaka',
            'tahun_terbit' => 2005,
            'isbn' => '9789793062792',
            'stok' => 5,
            'category_id' => 1,
            'kategori' => 'Fiksi'
        ],
        [
            'id' => 2,
            'judul' => 'Bumi Manusia',
            'penulis' => 'Pramoedya Ananta Toer',
            'penerbit' => 'Hasta Mitra',
            'tahun_terbit' => 1980,
            'isbn' => '9789794330746',
            'stok' => 3,
            'category_id' => 1,
            'kategori' => 'Fiksi'
        ],
        [
            'id' => 3,
            'judul' => 'Clean Code',
            'penulis' => 'Robert C. Martin',
            'penerbit' => 'Prentice Hall',
            'tahun_terbit' => 2008,
            'isbn' => '9780132350884',
            'stok' => 7,
            'category_id' => 2,
            'kategori' => 'Teknologi'
        ],
    ];

    public function index()
    {
        $books = $this->books;

        return view('books.index', compact('books'));
    }

    public function create()
    {
        $categories = $this->categories;

        return view('books.create', compact('categories'));
    }

    public function store(StoreBookRequest $request)
    {
        $validated = $request->validated();

        return redirect()->route('books.index')
            ->with(
                'success',
                "Buku \"{$validated['judul']}\" berhasil ditambahkan (data dummy, belum tersimpan ke database)."
            );
    }

    public function show(string $id)
    {
        $book = collect($this->books)->firstWhere('id', (int) $id);

        abort_if(! $book, 404);

        return view('books.show', compact('book'));
    }

    public function edit(string $id)
    {
        $book = collect($this->books)->firstWhere('id', (int) $id);

        abort_if(! $book, 404);

        $categories = $this->categories;

        return view('books.edit', compact('book', 'categories'));
    }

    public function update(Request $request, string $id)
    {
        $validated = $request->validate([
            'judul' => 'required|string|max:200',
            'penulis' => 'required|string|max:100',
            'penerbit' => 'required|string|max:100',
            'tahun_terbit' => 'required|integer|min:1900|max:' . date('Y'),
            'isbn' => 'nullable|string|max:20',
            'stok' => 'required|integer|min:0',
            'category_id' => 'required|integer',
        ]);

        return redirect()->route('books.index')
            ->with(
                'success',
                "Buku \"{$validated['judul']}\" berhasil diperbarui (data dummy, belum tersimpan ke database)."
            );
    }

    public function destroy(string $id)
    {
        return redirect()->route('books.index')
            ->with(
                'success',
                "Buku dengan id {$id} berhasil dihapus (data dummy, belum tersimpan ke database)."
            );
    }
}