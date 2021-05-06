<?php

namespace App\Models;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * @SWG\Definition(
 *      definition="TakeExam",
 *      required={"user_id", "exam_id", "status"},
 *      @SWG\Property(
 *          property="id",
 *          description="id",
 *          type="integer",
 *          format="int32"
 *      ),
 *      @SWG\Property(
 *          property="user_id",
 *          description="user_id",
 *          type="integer",
 *          format="int32"
 *      ),
 *      @SWG\Property(
 *          property="exam_id",
 *          description="exam_id",
 *          type="integer",
 *          format="int32"
 *      ),
 *      @SWG\Property(
 *          property="created_at",
 *          description="created_at",
 *          type="string",
 *          format="date-time"
 *      ),
 *      @SWG\Property(
 *          property="updated_at",
 *          description="updated_at",
 *          type="string",
 *          format="date-time"
 *      )
 * )
 */
class TakeExam extends BaseModel
{
    use SoftDeletes;

    use HasFactory;

    public $table = 'take_exams';

    protected $dates = ['deleted_at'];


    public $fillable = [
        'exam_id',
        'user_id',
        'status',
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'status' => 'integer',
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'exam_id' => 'required',
    ];

    public function exam() {
        return $this->belongsTo(Exam::class, 'exam_id','id');
    }

    public function user() {
        return $this->belongsTo(User::class, 'user_id','id');
    }

    public function answers() {
        return $this->hasMany(QuestionAnswer::class, 'take_exam_id', 'id');
    }

    public function getScoreAttribute() {
        $answers = $this->answers->pluck('answer_id', 'question_id');
        $score = 0;
        foreach ($this->exam->questions as $question) {
            $score += $question->answer->id == $answers[$question->id];
        }
        // dd(
        //     json_decode($this->exam->questions),
        //     $answers,
        //     $score
        // );
        return $score;
    }
}
