<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class TakeCourses extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('take_courses', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('user_id')
                    ->index()
                    ->references('id')
                    ->on('users');
                $table->unsignedInteger('course_id')
                    ->index()
                    ->references('id')
                    ->on('courses');
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
        Schema::dropIfExists('take_courses');
    }
}
