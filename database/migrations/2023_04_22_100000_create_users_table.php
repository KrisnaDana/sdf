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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('nim')->unique();
            $table->string('password');
            $table->string('nama_lengkap');
            $table->foreignId('jalur_pendaftaran_id')->constrained('jalur_pendaftarans'); //data termasuk mahasiswa lama
            $table->foreignId('program_studi_id')->constrained('program_studis');
            $table->year('angkatan');
            $table->enum('ganti_password', ['Sudah', 'Belum'])->default("Belum");
            $table->text('pas_foto')->nullable();
            $table->text('krm')->nullable();
            $table->enum('koordinator', ['Ya', 'Tidak'])->default('Tidak');
            $table->string('nama_panggilan')->nullable();
            $table->enum('status', ['Belum registrasi', 'Mengajukan registrasi', 'Kesalahan data registrasi', 'Mengajukan perbaikan registrasi', 'Teregistrasi'])->default('Belum registrasi');
            $table->enum('jenis_kelamin', ['Laki-laki', 'Perempuan'])->nullable();
            $table->enum('agama', ['Hindu', 'Islam', 'Budha', 'Konghucu', 'Kristen Protestan', 'Kristen Katolik', 'Kristen Advent', 'Penganut Kepercayaan'])->nullable();
            $table->enum('golongan_darah', ['A', 'B', 'AB', 'O'])->nullable();
            $table->string('tempat_lahir')->nullable();
            $table->date('tanggal_lahir')->nullable();
            $table->text('alamat_asal')->nullable();
            $table->text('alamat_sekarang')->nullable();
            $table->string('no_telepon')->nullable();
            $table->string('id_line')->nullable();
            $table->string('no_hp')->nullable();
            $table->string('email')->nullable();
            $table->string('asal_sekolah')->nullable();
            $table->text('alasan_kuliah')->nullable();
            $table->string('minat_bakat')->nullable();
            $table->string('cita_cita')->nullable();
            $table->string('idola')->nullable();
            $table->integer('jumlah_saudara')->unsigned()->default(0);
            $table->string('nama_ayah')->nullable();
            $table->string('nama_ibu')->nullable();
            $table->enum('konsumsi', ['Non-Vegetarian', 'Vegetarian'])->nullable();
            $table->string('penyakit_khusus')->nullable();
            $table->enum('organisasi', ['Ya', 'Tidak'])->nullable();
            $table->enum('prestasi', ['Ya', 'Tidak'])->nullable();
            $table->string('gugus');
            $table->string('no_gugus');
            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
