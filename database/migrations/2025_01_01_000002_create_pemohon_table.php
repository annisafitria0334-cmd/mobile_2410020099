<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('pemohon', function (Blueprint $table) {
            $table->id('id_pemohon');
            $table->unsignedBigInteger('id_akta');
            $table->string('nik_pemohon', 16)->unique();
            $table->string('nama_pemohon', 100);
            $table->date('tgl_lahir');
            $table->string('tempat_lahir', 100);
            $table->enum('jenis_kelamin', ['Laki-laki', 'Perempuan']);
            $table->text('alamat');
            $table->string('no_hp', 15);
            $table->string('username', 50)->unique();
            $table->string('password');
            $table->timestamps();

            $table->foreign('id_akta')
                  ->references('id_akta')->on('jenis_akta')
                  ->onUpdate('cascade')->onDelete('restrict');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pemohon');
    }
};
