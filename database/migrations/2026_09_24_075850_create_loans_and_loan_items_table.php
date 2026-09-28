<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::disableForeignKeyConstraints();

        Schema::create('loans', function (Blueprint $table) {
            $table->id();
            $table->foreignId('member_id')->constrained('members')->onDelete('cascade');
            $table->date('tanggal_pinjam');
            $table->date('tanggal_kembali');
            $table->enum('status', ['dipinjam', 'dikembalikan'])->default('dipinjam');
            $table->timestamps();
        });

        Schema::create('loan_items', function (Blueprint $table) {
            $table->id();
            $table->foreignId('loan_id')->constrained('loans')->onDelete('cascade');
            $table->foreignId('book_id')->constrained('books')->onDelete('cascade');
            $table->integer('jumlah')->default(1);
            $table->timestamps();
        });

        Schema::enableForeignKeyConstraints();
    }

    public function down(): void
    {
        Schema::disableForeignKeyConstraints();
        Schema::dropIfExists('loan_items');
        Schema::dropIfExists('loans');
        Schema::enableForeignKeyConstraints();
    }
};