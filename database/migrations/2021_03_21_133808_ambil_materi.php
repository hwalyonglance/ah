<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AmbilMateri extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create(
            'ambil_materi',
            function (Blueprint $table) {
                $table->bigIncrements('id');
                $table->unsignedBigInteger('materi_id')
                    ->index()
                    ->references('id')
                    ->on('materi');
                $table->unsignedBigInteger('user_id')
                    ->index()
                    ->references('id')
                    ->on('users');
                $table->unsignedInteger('status');
                $table->decimal('nilai');
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
