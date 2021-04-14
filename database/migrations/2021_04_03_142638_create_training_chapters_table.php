<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTrainingChaptersTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('training_chapters', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('training_id')->index();
            $table->string('judul');
            $table->string('video');
            $table->string('keterangan');
            $table->timestamps();
            $table->softDeletes();
            $table->foreign('training_id')->references('id')->on('trainings');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('training_chapters');
    }
}
