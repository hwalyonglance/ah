<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class MateriSoalJawaban extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create(
            'materi_soal_jawaban',
            function (Blueprint $table) {
                $table->unsignedBigInteger('materi_soal_id')
                    ->index()
                    ->references('id')
                    ->on('materi_soal');
                $table->unsignedBigInteger('materi_soal_pilihan_id')
                    ->index()
                    ->references('id')
                    ->on('materi_soal_pilihan');
                $table->unique(
                    [
                        'materi_soal_id',
                        'materi_soal_pilihan_id'
                    ]
                );
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
