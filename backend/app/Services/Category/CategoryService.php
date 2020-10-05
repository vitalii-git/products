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
}
