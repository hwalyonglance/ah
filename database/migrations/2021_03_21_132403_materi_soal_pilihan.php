<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class MateriSoalPilihan extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create(
            'materi_soal_pilihan',
            function (Blueprint $table) {
                $table->bigIncrements('id');
                $table->unsignedBigInteger('materi_soal_id')
                    ->index()
                    ->references('id')
                    ->on('materi_soal');
                $table->string('pilihan');
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
