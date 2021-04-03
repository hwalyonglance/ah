<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMaterisTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('materis', function (Blueprint $table) {
            $table->increments('id');
            $table->biginteger('role_id')->unsigned()->roles(id);
            $table->smallinteger('type');
            $table->string('gambar')->nullable();
            $table->string('judul');
            $table->string('keterangan');
            $table->timestamps();
            $table->softDeletes();
            $table->foreign('role_id')->references('')->on('');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('materis');
    }
}
