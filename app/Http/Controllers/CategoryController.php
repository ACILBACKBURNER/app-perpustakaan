<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CategoryController extends Controller
{
    // Tambahkan data dummy kategori
    private array $categories = [
        ['id' => 1, 'nama_kategori' => 'Teknologi', 'deskripsi' => 'Buku seputar teknologi dan pemrograman'],
        ['id' => 2, 'nama_kategori' => 'Novel', 'deskripsi' => 'Buku fiksi dan cerita novel'],
        ['id' => 3, 'nama_kategori' => 'Sains', 'deskripsi' => 'Buku ilmu pengetahuan alam'],
    ];

    public function index()
    {
        $categories = $this->categories;

        return view('categories.index', compact('categories'));
    }
}