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
 *          type="string"
 *      ),
 *      @SWG\Property(
 *          property="judul",
 *          description="judul",
 *          type="string"
 *      ),
 *      @SWG\Property(
 *          property="keterangan",
 *          description="keterangan",
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
class Training extends BaseModel
{
    use SoftDeletes;

    use HasFactory;

    public $table = 'trainings';


    protected $dates = ['deleted_at'];


    public $fillable = [
        'role_id',
        'gambar',
        'judul',
        'keterangan'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'gambar' => 'string',
        'judul' => 'string',
        'keterangan' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'role_id' => 'required',
        'judul' => 'required',
        'keterangan' => 'required'
    ];

    const JENIS = [
        1   => 'Training',  // bisa soal
        2   => 'Kursus',    // tanpa soal // kategori
    ];

    public function role(){
        return $this->belongsTo(Role::class, 'role_id','id');
    }
}
