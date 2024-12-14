<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('servis', function (Blueprint $table) {
            $table->id();
            $table->foreignId('booking_id')->constrained()->onDelete('cascade');
            $table->foreignId('motor_id')->constrained()->onDelete('cascade');
            $table->foreignId('category_id')->constrained('service_categories');
            $table->foreignId('mekanik_id')->nullable()->constrained();
            $table->text('detail_keluhan');
            $table->text('diagnosis')->nullable();
            $table->text('tindakan')->nullable();
            $table->decimal('total_biaya', 10, 2)->nullable();
            $table->enum('status', ['pending', 'in_progress', 'completed', 'cancelled'])->default('pending');
            $table->timestamp('waktu_mulai')->nullable();
            $table->timestamp('waktu_selesai')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('servis');
    }
};