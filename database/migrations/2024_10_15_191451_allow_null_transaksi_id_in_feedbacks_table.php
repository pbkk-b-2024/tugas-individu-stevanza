<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AllowNullTransaksiIdInFeedbacksTable extends Migration
{
    public function up()
    {
        Schema::table('feedbacks', function (Blueprint $table) {
            $table->unsignedBigInteger('transaksi_id')->nullable()->change();
        });
    }

    public function down()
    {
        Schema::table('feedbacks', function (Blueprint $table) {
            $table->unsignedBigInteger('transaksi_id')->nullable(false)->change();
        });
    }
}