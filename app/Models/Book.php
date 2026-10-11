<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    protected $fillable = [
        'judul', 'penulis', 'penerbit', 'tahun_terbit',
        'isbn', 'stok', 'category_id', 'sampul',
    ];

 public function category()
{
    return $this->belongsTo(Category::class);
}

public function loanItems()
{
    return $this->hasMany(LoanItem::class);
}
}