<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class QuestionAnswers extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('question_answers', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('take_exam_id')
                ->index()
                ->references('id')
                ->on('take_exams');
            $table->unsignedInteger('question_id')
                ->index()
                ->references('id')
                ->on('questions');
            $table->unsignedInteger('answer_id')
                ->index()
                ->references('id')
                ->on('question_options');
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
        Schema::dropIfExists('question_answers');
    }
}
