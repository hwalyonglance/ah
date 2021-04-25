<?php

namespace App\Models;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * @SWG\Definition(
 *      definition="Training",
 *      required={"role_id", "type", "judul", "keterangan"},
 *      @SWG\Property(
 *          property="id",
 *          description="id",
 *          type="integer",
 *          format="int32"
 *      ),
 *      @SWG\Property(
 *          property="gambar",
 *          description="gambar",
 *          type="integer"
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
class TakeTraining extends BaseModel
{
    use SoftDeletes;

    use HasFactory;

    public $table = 'take_trainings';


    protected $dates = ['deleted_at'];


    public $fillable = [
        'training_id',
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
        'training_id' => 'required',
    ];

    public function training() {
        return $this->belongsTo(Training::class, 'training_id','id');
    }

    public function user() {
        return $this->belongsTo(User::class, 'user_id','id');
    }
}
