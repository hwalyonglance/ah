<?php

namespace App\Models;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * @SWG\Definition(
 *      definition="Exam",
 *      required={"role_id", "image_url", "title", "description"},
 *      @SWG\Property(
 *          property="id",
 *          description="id",
 *          type="integer",
 *          format="int32"
 *      ),
 *      @SWG\Property(
 *          property="image_url",
 *          description="image_url",
 *          type="string"
 *      ),
 *      @SWG\Property(
 *          property="title",
 *          description="title",
 *          type="string"
 *      ),
 *      @SWG\Property(
 *          property="description",
 *          description="description",
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
class Exam extends BaseModel
{
    use SoftDeletes;

    use HasFactory;

    public $table = 'exams';


    protected $dates = ['deleted_at'];



    public $fillable = [
        'role_id',
        'image_url',
        'title',
        'description'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'image_url' => 'string',
        'title' => 'string',
        'description' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'role_id' => 'required',
        // 'image_url' => 'required',
        'title' => 'required',
        'description' => 'required'
    ];

    public function questions() {
        return $this->hasMany(Question::class, 'exam_id');
    }

    public function role() {
        return $this->belongsTo(\App\Models\Role::class, 'role_id');
    }

    public function taker() {
        return $this->hasMany(TakeExam::class, 'exam_id');
    }
}
