<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

    public function up(): void
    {
        Schema::create('tasks', function (Blueprint $table) {
            $table->id();
            $table->string('judul');
            $table->enum('tipe', ['masuk', 'keluar']);

            $table->foreignId('barang_id')
                ->constrained('barang')
                ->cascadeOnDelete();

            $table->integer('jumlah');

            $table->foreignId('user_id')
                ->constrained('users')
                ->cascadeOnDelete();

            $table->foreignId('supplier_id')
                ->nullable()
                ->constrained('supplier')
                ->nullOnDelete();

            $table->enum('status', ['pending', 'selesai'])
                ->default('pending');

            $table->timestamps();
        });
    }


    public function down(): void
    {
        Schema::dropIfExists('tasks');
    }
};
