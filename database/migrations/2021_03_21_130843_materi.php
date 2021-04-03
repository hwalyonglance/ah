<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Materi extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create(
            'materi',
            function (Blueprint $table) {
                $table->bigIncrements('id');
                $table->unsignedBigInteger('role_id')
                    ->nullable()
                    ->index()
                    ->references('id')
                    ->on('roles');

                $table->smallInteger('type');
                $table->string('gambar');
                $table->string('judul');
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
