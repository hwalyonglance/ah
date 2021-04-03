<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AmbilMateriBab extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create(
            'ambil_materi_bab',
            function (Blueprint $table) {
                $table->bigIncrements('id');
                $table->unsignedBigInteger('materi_bab_id')
                    ->index()
                    ->references('id')
                    ->on('materi_bab');
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
