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
        Schema::table('servis', function (Blueprint $table) {
            // Hapus kolom lama yang tidak diperlukan lagi (opsional)
            // $table->dropColumn(['nama', 'deskripsi', 'harga']);
            
            // Tambah kolom baru
            if (!Schema::hasColumn('servis', 'category_id')) {
                $table->foreignId('category_id')->nullable()->after('motor_id')
                    ->constrained('service_categories')->nullOnDelete();
            }
            
            if (!Schema::hasColumn('servis', 'detail_keluhan')) {
                $table->text('detail_keluhan')->nullable()->after('category_id');
            }
            
            if (!Schema::hasColumn('servis', 'diagnosis')) {
                $table->text('diagnosis')->nullable()->after('detail_keluhan');
            }
            
            if (!Schema::hasColumn('servis', 'tindakan')) {
                $table->text('tindakan')->nullable()->after('diagnosis');
            }
            
            if (!Schema::hasColumn('servis', 'total_biaya')) {
                $table->decimal('total_biaya', 10, 2)->nullable()->after('tindakan');
            }
            
            if (!Schema::hasColumn('servis', 'waktu_mulai')) {
                $table->timestamp('waktu_mulai')->nullable()->after('status');
            }
            
            if (!Schema::hasColumn('servis', 'waktu_selesai')) {
                $table->timestamp('waktu_selesai')->nullable()->after('waktu_mulai');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('servis', function (Blueprint $table) {
            // Hapus kolom-kolom yang ditambahkan
            $table->dropForeign(['category_id']);
            $table->dropColumn([
                'category_id',
                'detail_keluhan',
                'diagnosis',
                'tindakan',
                'total_biaya',
                'waktu_mulai',
                'waktu_selesai'
            ]);
        });
    }
};