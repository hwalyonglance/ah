<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class MateriBab extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create(
            'materi_bab',
            function (Blueprint $table) {
                $table->bigIncrements('id');
                $table->unsignedBigInteger('materi_id')
                    ->index()
                    ->references('id')
                    ->on('materi');
                $table->string('video');
                $table->string('keterangan');
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
