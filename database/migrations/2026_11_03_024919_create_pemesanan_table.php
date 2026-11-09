<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
   public function up(): void
{
    Schema::create('pemesanan', function (Blueprint $table) {
        $table->id();
        $table->string('nama');
        $table->string('email');
        $table->string('jenis_kelamin');
        $table->string('no_identitas', 16);
        $table->string('tipe_kamar');
        $table->decimal('harga', 12, 2);
        $table->date('tanggal');
        $table->integer('durasi');
        $table->boolean('breakfast')->default(false);
        $table->decimal('total_bayar', 12, 2);
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pemesanan');
    }
};
