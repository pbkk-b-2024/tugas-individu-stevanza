<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddPelangganIdToServisTable extends Migration
{
    public function up()
    {
        Schema::table('servis', function (Blueprint $table) {
            $table->unsignedBigInteger('pelanggan_id')->nullable();
            $table->foreign('pelanggan_id')->references('id')->on('pelanggans')->onDelete('set null');
        });
    }

    public function down()
    {
        Schema::table('servis', function (Blueprint $table) {
            $table->dropForeign(['pelanggan_id']);
            $table->dropColumn('pelanggan_id');
        });
    }
}