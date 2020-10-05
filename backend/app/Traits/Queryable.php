<?php


namespace App\Traits;


use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\ModelNotFoundException;

trait Queryable
{
    /**
     * Array of "with" relations
     *
     * @var array
     */
    protected $with = [];

    /**
     * Array of "withCount" relations
     *
     * @var array
     */
    protected $withCount = [];

    /**
     * Find model by PK
     *
     * @param $key
     * @return Model|null
     */
    public function find($key): ?Model
    {
        return $this->getQuery()->whereKey($key)->first();
    }

    /**
     * Find or fail by primary key or custom column
     *
     * @param $value
     * @param string|null $column
     * @return Model
     */
    public function findOrFail($value, ?string $column = null): Model
    {
        if (is_null($column)) {
            return $this->getQuery()->findOrFail($value);
        }

        if (is_null($model = $this->getQuery()->where($column, $value)->first())) {
            throw (new ModelNotFoundException)->setModel(get_class($model), $value);
        }

        return $model;
    }

    /**
     * Get filtered collection
     *
     * @param array $search
     * @return Collection
     */
    public function getAll(array $search = []): Collection
    {
        return $this->getFilteredQuery($search)->get();
    }

    /**
     * Get paginated data
     *
     * @param array $search
     * @param int $pageSize
     * @return LengthAwarePaginator
     */
    public function getAllPaginated(array $search = [], int $pageSize = 15): LengthAwarePaginator
    {
        return $this->getFilteredQuery($search)->paginate($pageSize);
    }

    /**
     * Set with
     *
     * @param array $with
     * @return Queryable
     */
    public function with(array $with)
    {
        $this->with = $with;

        return $this;
    }

    /**
     * Set with count
     *
     * @param array $withCount
     * @return Queryable
     */
    public function withCount(array $withCount)
    {
        $this->withCount = $withCount;

        return $this;
    }

    /**
     * Get filtered query
     *
     * @param array $search
     * @return Builder
     */
    protected function getFilteredQuery(array $search = []): Builder
    {
        return $this->getQuery()->orderBy('id', 'desc');
    }

    /**
     * @return Builder
     */
    protected function getQuery(): Builder
    {
        $query = $this->modelClass::query();

        if (!empty($this->with)) {
            $query->with($this->with);
        }

        if (!empty($this->withCount)) {
            $query->withCount($this->withCount);
        }

        return $query;
    }
}
