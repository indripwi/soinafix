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
        Schema::create('prestasis', function (Blueprint $table) {
            $table->id();
            $table->string('slug', 255)->nullable();
            $table->string('nama_atlet', 100); // nama_atlet: VARCHAR(100), NOT NULL
            $table->string('cabang_olahraga', 100); // cabang_olahraga: VARCHAR(100), NOT NULL
            $table->text('deskripsi'); // deskripsi: TEXT, NOT NULL
            $table->string('foto_url', 250);
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
        Schema::dropIfExists('prestasis');
    }
};
