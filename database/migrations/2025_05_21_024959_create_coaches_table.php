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
        Schema::create('coaches', function (Blueprint $table) {
            $table->id();
            $table->string('slug', 255)->nullable();
            $table->string('full_name', 255); // full_name: VARCHAR(255), NOT NULL
            $table->string('jabatan', 255); // jabatan: VARCHAR(255), NOT NULL
            $table->string('foto_url', 255); // foto_url: VARCHAR(255), NOT NULL
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
        Schema::dropIfExists('coaches');
    }
};
