<?php

declare (strict_types=1);
namespace App\Model;

use Hyperf\Database\Model\SoftDeletes;
use Hyperf\DbConnection\Model\Model;
/**
 * @property int $id 
 * @property string $name 
 * @property string $type 
 * @property int $parent_id 
 * @property string $path 
 * @property string $path_id 
 * @property float $weight 
 * @property string $deleted_at 
 * @property \Carbon\Carbon $created_at 
 * @property \Carbon\Carbon $updated_at 
 */
class Category extends Model
{
    use SoftDeletes;
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'categories';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [];
    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = ['id' => 'integer', 'parent_id' => 'integer', 'weight' => 'float', 'created_at' => 'datetime', 'updated_at' => 'datetime'];

    public function article()
    {
        return self::hasMany(Article::class, 'category_id', 'id');
    }
}