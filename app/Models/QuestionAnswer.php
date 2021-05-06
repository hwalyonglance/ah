<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * @SWG\Definition(
 *      definition="Question",
 *      required={"take_exam_id","question_id","answer_id"},
 *      @SWG\Property(
 *          property="id",
 *          description="id",
 *          type="integer",
 *          format="int32"
 *      ),
 *      @SWG\Property(
 *          property="take_exam_id",
 *          description="take_exam_id",
 *          type="integer",
 *          format="int32"
 *      ),
 *      @SWG\Property(
 *          property="question_id",
 *          description="question_id",
 *          type="integer",
 *          format="int32"
 *      ),
 *      @SWG\Property(
 *          property="answer_id",
 *          description="answer_id",
 *          type="integer",
 *          format="int32"
 *      ),
 *      @SWG\Property(
 *          property="status",
 *          description="status",
 *          type="integer",
 *          format="int4"
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
class QuestionAnswer extends Model
{
    use SoftDeletes;

    use HasFactory;

    public $table = 'question_answers';


    protected $dates = ['deleted_at'];



    public $fillable = [
        'take_exam_id',
        'question_id',
        'answer_id',
        'status',
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'question_id' => 'integer',
        'answer_id' => 'integer',
        'status' => 'integer',
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'take_exam_id' => 'required',
        'question_id' => 'required',
        'answer_id' => 'required',
        'status' => 'required',
    ];

    public function answer() {
        return $this
            ->hasOne(QuestionOption::class, 'question_id')
            ->where('status', 1);
    }

    public function exam() {
        return $this->belongsTo(Exam::class, 'take_exam_id');
    }
}
