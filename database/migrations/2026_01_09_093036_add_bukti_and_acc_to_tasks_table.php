<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::table('tasks', function (Blueprint $table) {
            $table->string('bukti_foto')->nullable();
            $table->enum('status', 
            ['pending', 'menunggu_acc', 'selesai', 'ditolak'])
                ->default('pending')
                ->change();
            $table->timestamp('acc_at')->nullable();
            $table->foreignId('acc_by')->nullable()
            ->constrained('users');
        });
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('tasks', function (Blueprint $table) {
            //
        });
    }
};
