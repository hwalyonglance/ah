<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * @SWG\Definition(
 *      definition="Question",
 *      required={"exam_id", "question"},
 *      @SWG\Property(
 *          property="id",
 *          description="id",
 *          type="integer",
 *          format="int32"
 *      ),
 *      @SWG\Property(
 *          property="question",
 *          description="question",
 *          type="string"
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
class Question extends Model
{
    use SoftDeletes;

    use HasFactory;

    public $table = 'questions';


    protected $dates = ['deleted_at'];



    public $fillable = [
        'exam_id',
        'question'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'question' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'exam_id' => 'required',
        'question' => 'required'
    ];

    public function answer() {
        return $this
            ->hasOne(QuestionOption::class, 'question_id')
            ->where('status', 1);
    }

    public function exam() {
        return $this->belongsTo(Exam::class, 'exam_id');
    }

    public function options() {
        return $this->hasMany(QuestionOption::class, 'question_id');
    }
}
