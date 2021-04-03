<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMateriBabsTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('materi_babs', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedBigInteger('materi_id');
            $table->string('video');
            $table->string('keterangan');
            $table->timestamps();
            $table->softDeletes();
            $table->foreign('materi_id')->references('id')->on('materis');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('materi_babs');
    }
}
