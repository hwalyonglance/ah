<?php

namespace App\Models;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * @SWG\Definition(
 *      definition="Course",
 *      required={"role_id", "category_id", "gambar", "title", "description"},
 *      @SWG\Property(
 *          property="id",
 *          description="id",
 *          type="integer",
 *          format="int32"
 *      ),
 *      @SWG\Property(
 *          property="gambar",
 *          description="gambar",
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
class Course extends BaseModel
{
    use SoftDeletes;

    use HasFactory;

    public $table = 'courses';


    protected $dates = ['deleted_at'];



    public $fillable = [
        'role_id',
        'category_id',
        'gambar',
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
        'gambar' => 'string',
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
        'category_id' => 'required',
        'title' => 'required',
        'description' => 'required'
    ];

    public function category() {
        return $this->belongsTo(CourseCategory::class, 'category_id');
    }

    public function role() {
        return $this->belongsTo(Role::class, 'role_id');
    }
}
