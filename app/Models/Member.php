<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Member extends Model
{
    use HasFactory;

    protected $table = 'members';

    protected $fillable = [
        'nama',
        'nim',
        'email',
        'nomor_telepon',
        'alamat',
        'status',
    ];

    /**
     * Relasi ke model Loan (One to Many)
     * Satu anggota bisa memiliki banyak transaksi peminjaman.
     */
    public function loans()
    {
        return $this->hasMany(Loan::class);
    }
}