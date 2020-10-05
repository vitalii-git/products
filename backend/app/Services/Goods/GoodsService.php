<?php


namespace App\Services\Goods;


use App\Models\Goods;
use App\Services\Base\AbstractService;
use Illuminate\Database\Eloquent\Model;

/**
 * Class GoodsService
 * @package App\Services
 */
class GoodsService extends AbstractService
{
    /**
     * @var string
     */
    public $modelClass = Goods::class;

    /**
     * @var string[]
     */
    protected $with = ['categories'];

    /**
     * @param array $data
     * @return Model|null
     */
    public function create(array $data): ?Model
    {
        /**
         * @var Goods $goods
         */
        $goods = parent::create($data);

        if (isset($data['categories']) && $data['categories']) {
            $goods->sync($data['categories']);
        }

        return $goods;
    }

    /**
     * @param Model|mixed $keyOrModel
     * @param array $data
     * @return Model|null
     */
    public function update($keyOrModel, array $data): ?Model
    {
        /**
         * @var Goods $goods
         */
        $category = parent::update($keyOrModel, $data);

        if (isset($data['categories']) && $data['categories']) {
            $goods->sync($data['categories']);
        }

        return $category;
    }


}
