<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::dropIfExists('books'); // Hapus tabel dulu jika kebetulan tersangkut

        Schema::create('books', function (Blueprint $table) {
            $table->id();
            $table->string('judul', 200);
            $table->string('penulis', 100);
            $table->string('penerbit', 100);
            $table->year('tahun_terbit');
            $table->string('isbn', 20)->unique()->nullable();
            $table->integer('stok')->default(1);
            $table->foreignId('category_id')->constrained('categories');
            $table->string('sampul')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('books');
    }
};