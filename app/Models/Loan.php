<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model; // Perhatikan tambahan 'Eloquent' di sini

class Loan extends Model
{
    use HasFactory;

    protected $fillable = [
        'member_id',
        'tanggal_pinjam',
        'tanggal_kembali',
        'status',
    ];

    public function member()
    {
        return $this->belongsTo(Member::class);
    }

    public function loanItems()
    {
        return $this->hasMany(LoanItem::class);
    }
}