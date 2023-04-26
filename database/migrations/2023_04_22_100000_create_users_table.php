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
            $table->string('password_no_encrypt')->nullable();
            $table->string('nama_lengkap');
            $table->foreignId('jalur_pendaftaran_id')->constrained('jalur_pendaftarans');
            $table->foreignId('program_studi_id')->constrained('program_studis');
            $table->foreignId('angkatan_id')->constrained('angkatans');
            $table->enum('mahasiswa', ['Mahasiswa baru', 'Mahasiswa lama'])->nullable();
            $table->enum('ganti_password', ['Sudah', 'Belum'])->nullable();
            $table->string('file_profil')->nullable();
            $table->string('file_krm_lainnya')->nullable();
            $table->enum('koordinator', ['Ya', 'Tidak'])->nullable();
            $table->string('nama_panggilan')->nullable();
            $table->enum('status', ['Belum terdaftar', 'Terverifikasi'])->nullable();
            $table->enum('jenis_kelamin', ['Laki-laki', 'Perempuan'])->nullable();
            $table->enum('agama', ['Hindu', 'Islam', 'Budha', 'Konghucu', 'Kristen Protestan', 'Kristen Katolik', 'Kristen Advent', 'Penganut Kepercayaan'])->nullable();
            $table->enum('golongan_darah', ['A', 'B', 'AB', 'O'])->nullable();
            $table->string('tempat_lahir')->nullable();
            $table->date('tanggal_lahir')->nullable();
            $table->text('alamat')->nullable();
            $table->text('alamat_sekarang')->nullable();
            $table->string('no_telepon')->nullable();
            $table->string('id_line')->nullable();
            $table->string('no_hp')->nullable();
            $table->string('email')->nullable();
            $table->string('asal_sekolah')->nullable();
            $table->string('cita-cita')->nullable();
            $table->string('idola')->nullable();
            $table->integer('jumlah_saudara')->unsigned()->default(0);
            $table->string('nama_ayah')->nullable();
            $table->string('nama_ibu')->nullable();
            $table->enum('konsumsi', ['Normal', 'Vegetarian', 'Vegan'])->nullable();
            $table->string('penyakit_khusus')->nullable();
            $table->string('minat_bakat')->nullable();
            $table->timestamp('email_verified_at')->nullable();
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
