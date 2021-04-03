<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AmbilMateriSoalJawaban extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create(
            'ambil_materi_soal_jawaban',
            function (Blueprint $table) {
                $table->bigIncrements('id');
                $table->unsignedBigInteger('soal_id')
                    ->index()
                    ->references('id')
                    ->on('materi_soal');
                $table->unsignedBigInteger('jawaban_id')
                    ->index()
                    ->references('id')
                    ->on('materi_soal_pilihan');
                $table->unsignedInteger('status');
                $table->timestamps();
            }
        );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
