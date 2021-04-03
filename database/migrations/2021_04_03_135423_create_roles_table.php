<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRolesTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('roles', function (Blueprint $table) {
            $table->increments('id');
            $table->bigInteger('role_id')->unsigned()->roles(id);
            $table->smallInteger('type');
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
        Schema::drop('roles');
    }
}
