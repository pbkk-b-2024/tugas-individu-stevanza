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
    Schema::create('orders', function (Blueprint $table) {
        $table->id();
        $table->foreignId('user_id')->constrained();
        $table->foreignId('produk_id')->constrained();
        $table->integer('quantity');
        $table->decimal('total_price', 10, 2);
        $table->text('address');
        $table->string('payment_method');
        $table->string('status')->default('pending');
        $table->text('address')->after('total_price');
        $table->string('payment_method')->after('address');
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
