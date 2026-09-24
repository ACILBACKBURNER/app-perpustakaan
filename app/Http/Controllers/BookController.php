<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Category;
use Illuminate\Http\Request;

class BookController extends Controller
{
    public function index()
    {
        // Mengambil data buku beserta relasi category-nya dan dipaginasi
        $books = Book::with('category')->paginate(10);

        return view('books.index', compact('books'));
    }

    public function create()
    {
        // Mengambil daftar kategori untuk pilihan dropdown di form tambah buku
        $categories = Category::all();

        return view('books.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'judul' => 'required|string|max:200',
            'penulis' => 'required|string|max:100',
            'penerbit' => 'required|string|max:100',
            'tahun_terbit' => 'required|digits:4|integer',
            'isbn' => 'nullable|string|max:20|unique:books,isbn',
            'stok' => 'required|integer|min:0',
            'category_id' => 'required|exists:categories,id',
            'sampul' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        // Tangani upload file sampul jika ada
        if ($request->hasFile('sampul')) {
            $path = $request->file('sampul')->store('sampul-buku', 'public');
            $validated['sampul'] = $path;
        }

        Book::create($validated);

        return redirect()->route('books.index')
            ->with('success', "Buku \"{$validated['judul']}\" berhasil ditambahkan.");
    }

    public function edit(string $id)
    {
        $book = Book::findOrFail($id);
        $categories = Category::all();

        return view('books.edit', compact('book', 'categories'));
    }

    public function update(Request $request, string $id)
    {
        $book = Book::findOrFail($id);

        $validated = $request->validate([
            'judul' => 'required|string|max:200',
            'penulis' => 'required|string|max:100',
            'penerbit' => 'required|string|max:100',
            'tahun_terbit' => 'required|digits:4|integer',
            'isbn' => 'nullable|string|max:20|unique:books,isbn,' . $book->id,
            'stok' => 'required|integer|min:0',
            'category_id' => 'required|exists:categories,id',
            'sampul' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        if ($request->hasFile('sampul')) {
            $path = $request->file('sampul')->store('sampul-buku', 'public');
            $validated['sampul'] = $path;
        }

        $book->update($validated);

        return redirect()->route('books.index')
            ->with('success', "Buku \"{$validated['judul']}\" berhasil diperbarui.");
    }

    public function destroy(string $id)
    {
        $book = Book::findOrFail($id);
        $book->delete();

        return redirect()->route('books.index')
            ->with('success', 'Buku berhasil dihapus.');
    }
}