<?php

declare (strict_types=1);

namespace App\Model;

use Hyperf\Database\Model\Events\Deleting;
use Hyperf\Database\Model\SoftDeletes;
use Hyperf\DbConnection\Model\Model;

/**
 * @property int $id
 * @property string $title
 * @property int $category_id
 * @property string $deleted_at
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 */
class Article extends Model
{
    use SoftDeletes;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'articles';
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
    protected $casts = ['id' => 'integer', 'created_at' => 'datetime', 'updated_at' => 'datetime'];

    public function content()
    {
        return self::hasOne(ArticlesContent::class);
    }

    public function category()
    {
        return self::belongsTo(Category::class, 'category_id', 'id');
    }

    public function deleting(Deleting $event)
    {
        $this->content()->delete();
    }

    public function tags()
    {
        return $this->morphToMany(Tag::class, 'tagable', 'tagable')->withTimestamps();
    }

}