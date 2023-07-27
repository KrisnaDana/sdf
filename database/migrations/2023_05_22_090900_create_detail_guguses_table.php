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
        Schema::create('detail_guguses', function (Blueprint $table) {
            $table->id();
            $table->foreignId('gugus_id')->constrained('guguses');
            $table->foreignId('user_id')->constrained('users');
            $table->integer('no_gugus_mahasiswa')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('detail_guguses');
    }
};
