<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up() {
        Schema::create('siswas', function (Blueprint $table) {
            $table->id();
            $table->string('uid_kartu')->unique();
            $table->string('nama')->nullable();
            $table->string('gambar')->nullable();
            $table->string('nis')->nullable();
            $table->integer('poin')->default('100');
            $table->string('nomor_orangtua')->nullable();
            $table->text('alamat')->nullable();
            $table->string('kelas')->nullable();
            $table->timestamps();
        });
    }

    public function down() {
        Schema::dropIfExists('siswas');
    }
};
