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
        Schema::create('motors', function (Blueprint $table) {
            $table->id();
            $table->string('merk');
            $table->string('model');
            $table->integer('tahun');
            $table->string('nomor_plat');
            $table->foreignId('pelanggan_id')->constrained('pelanggans');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('motors');
    }
};
