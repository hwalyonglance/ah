<?php

namespace Database\Seeders;

use DB;
use Illuminate\Database\Seeder;


use App\Models\Exam;
use App\Models\Question;
use App\Models\QuestionOption;

class CloneExam extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        try {
            DB::beginTransaction();
            $exams = Exam::with('questions.options')->get();
            foreach ($exams as $exam) {
                $newExam = Exam::create(
                    [
                        'role_id'     => $exam->role_id,
                        'image_url'   => $exam->image_url,
                        'title'       => 'Copy: '.$exam->title,
                        'description' => 'Copy: '.$exam->description,
                    ]
                );
                foreach ($exam->questions as $question) {
                    $newQuestion = Question::create(
                        [
                            'exam_id'   => $newExam->id,
                            'question'  => $question->question,
                        ]
                    );
                    $newOptions = [];
                    foreach ($question->options as $option) {
                        $newOptions[] = new QuestionOption(
                            [
                                'question_id'  => $newQuestion->id,
                                'option'       => $option->option,
                                'status'       => $option->status,
                            ]
                        );
                        $newQuestion->options()->saveMany($newOptions);
                    }
                }
            }
            DB::commit();
        } catch (\Throwable $e) {
            DB::rollback();
            dd($e);
        }
    }
}
