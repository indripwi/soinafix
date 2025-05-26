<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pendaftarans', function (Blueprint $table) {
            $table->id();
            $table->string('slug', 255)->nullable();
            $table->unsignedBigInteger('user_id')->nullable(); // NULLABLE agar bisa ON DELETE SET NULL
            $table->foreign('user_id')->references('id')->on('users')->onDelete('set null');
            $table->string('nama_pendaftar', 100);
            $table->string('nik', 20);
            $table->string('nomor_telepon', 20);
            $table->enum('jenis_kelamin', ['Laki-laki', 'Perempuan']);
            $table->string('tempat_lahir', 100);
            $table->date('tanggal_lahir');
            $table->text('alamat');
            $table->string('sekolah', 100);
            $table->string('kelas', 20);

            // File uploads
            $table->string('file_akta', 255);
            $table->string('file_kk', 255);
            $table->string('file_foto', 255);
            $table->string('file_raport', 255);
            $table->string('file_psikolog', 255);
            $table->timestamp('tanggal_daftar')->useCurrent();
            $table->enum('status_verifikasi', ['Menunggu', 'Lulus', 'Tidak Lulus'])->default('Menunggu');
            $table->string('periode')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pendaftarans');
    }
};
