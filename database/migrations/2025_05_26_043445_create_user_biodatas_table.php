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
        Schema::create('user_biodatas', function (Blueprint $table) {
            $table->id();
            $table->string('slug', 255)->nullable();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('nama_user')->nullable();
            $table->string('email')->nullable();
            $table->string('telepon')->nullable();
            $table->string('alamat')->nullable();
            $table->string('foto')->nullable();
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
        Schema::dropIfExists('user_biodatas');
    }
};
