<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Builder;

/**
 * Class Goods
 * @package App\Models
 */
class Goods extends Model
{
    use SoftDeletes;

    /**
     * @var string[]
     */
    protected $fillable = [
        'name',
        'quantity',
        'price',
        'is_published',
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function categories()
    {
        return $this->belongsToMany(
            Category::class,
            'goods_categories',
            'goods_id',
            'category_id'
        );
    }

    /**
     * @param $query
     * @param string $name
     * @return mixed
     */
    public function scopeName($query, string $name)
    {
        return $query->where('name', 'like', '%'. $name . '%');
    }

    /**
     * @param $query
     * @param $price
     * @return mixed
     */
    public function scopePrice($query, $price)
    {
        return count($price = explode(',', $price)) == 2 ?
            $query->whereBetween('price', [$price[0], $price[1]]) : $query;
    }

    /**
     * @param $query
     * @param $status
     * @return mixed
     */
    public function scopePublished($query, $status)
    {
        return $query->where('is_published', $status);
    }

    /**
     * @param $query
     * @param $id
     * @return mixed
     */
    public function scopeCategory_id($query, $id)
    {
        return $query->whereHas('categories', function (Builder $q) use ($id) {
            $q->where('id', $id);
        });
    }

    /**
     * @param $query
     * @param $name
     * @return mixed
     */
    public function scopeCategory_name($query, $name)
    {
        return $query->whereHas('categories', function (Builder $q) use ($name) {
            $q->where('name', 'like', '%' . $name . '%');
        });
    }

    /**
     * @param $query
     * @param $status
     * @return mixed
     */
    public function scopeDeleted($query, $status)
    {
        return $status ? $query->withTrashed() : $query;
    }
}
