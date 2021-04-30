<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class TakeExams extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('take_exams', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('user_id')
                ->index()
                ->references('id')
                ->on('users');
            $table->unsignedInteger('exam_id')
                ->index()
                ->references('id')
                ->on('exams');
            $table->tinyInteger('status')->index();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('take_exams');
    }
}
