<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class TakeTraining extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create(
            'take_trainings',
            function (Blueprint $table) {
                $table->id();
                $table->unsignedInteger('user_id')
                    ->index()
                    ->references('id')
                    ->on('users');
                $table->unsignedInteger('training_id')
                    ->index()
                    ->references('id')
                    ->on('users');
                $table->tinyInteger('status')->index();
                $table->softDeletes();
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
