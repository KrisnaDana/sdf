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
        Schema::create('guguses', function (Blueprint $table) {
            $table->id();
            $table->string('gugus')->default(0);
            $table->string('link_gugus')->nullable();
            $table->string('file_qr_gugus')->nullable();
            $table->string('no_gugus_mahasiswa_terakhir')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('guguses');
    }
};
