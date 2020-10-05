<?php


namespace App\Services\Base;


use App\Traits\Crudable;
use App\Traits\Queryable;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Collection as SupportCollection;
use Illuminate\Support\Facades\DB;

/**
 * Class AbstractService
 * @package App\Services\Base
 */
abstract class AbstractService
{
    use Crudable, Queryable;

    /**
     * @var
     */
    public $modelClass;
}
