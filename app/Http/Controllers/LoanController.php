<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LoanController extends Controller
{
    private array $loans = [
        ['id' => 1, 'nama_peminjam' => 'Siti Aminah', 'judul_buku' => 'Pemrograman Laravel untuk Pemula', 'tanggal_pinjam' => '2026-09-20', 'tanggal_kembali' => '2026-09-27', 'status' => 'dipinjam'],
        ['id' => 2, 'nama_peminjam' => 'Budi Santoso', 'judul_buku' => 'Algoritma dan Struktur Data', 'tanggal_pinjam' => '2026-09-15', 'tanggal_kembali' => '2026-09-22', 'status' => 'dikembalikan'],
    ];

    public function index()
    {
        $loans = $this->loans;

        return view('loans.index', compact('loans'));
    }
}