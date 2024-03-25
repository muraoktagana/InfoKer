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
        Schema::create('lowongans', function (Blueprint $table) {
            $table->id();
            $table->string('judul');
            $table->text('deskripsi');
            $table->enum('lokasi_kerja',['on_site','remote','hybrid']);
            $table->string('tag');
            $table->text('file');
            $table->dateTime('waktu_posting');
            $table->enum('status',['active','non_active']);
            $table->string('alumni_nisn')->nullable()->index();
            $table->foreign('alumni_nisn')->references('nisn')->on('alumnis');
            $table->unsignedBigInteger('perusahaan_id')->index();
            $table->foreign('perusahaan_id')->references('id')->on('perusahaans');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('lowongans');
    }
};
