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
        Schema::create('alumnis', function (Blueprint $table) {
            $table->string('nisn');
            $table->primary('nisn');
            $table->string('nama_lengkap');
            $table->enum('jenis_kelamin',['laki_laki', 'perempuan']);
            $table->string('jurusan');
            $table->integer('tahun_kelulusan');
            $table->text('alamat');
            $table->text('kontak');
            $table->text('foto_profil')->nullable();
            $table->unsignedBigInteger('user_id')->index();
            $table->foreign('user_id')->references('id')->on('users');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('alumnis');
    }
};
