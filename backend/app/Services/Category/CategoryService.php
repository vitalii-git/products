<?php


namespace App\Services\Category;


use App\Models\Category;
use App\Services\Base\AbstractService;

/**
 * Class CategoryService
 * @package App\Services\Category
 */
class CategoryService extends AbstractService
{
    /**
     * @var string
     */
    public $modelClass = Category::class;

    /**
     * @param \Illuminate\Database\Eloquent\Model|mixed $keyOrModel
     * @return bool
     * @throws \Exception
     */
    public function delete($keyOrModel): bool
    {
        /**
         * @var Category $category
         */
        $category = parent::findOrFail($keyOrModel);

        if ($category->goods()->count()) {
            return false;
        }

        return parent::delete($keyOrModel);
    }

}
