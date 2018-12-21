<?php

namespace App\Repositories;

use App\Repositories\Contracts\RepositoryInterface;
use Illuminate\Database\Eloquent\Model;

class Repository implements RepositoryInterface
{
    /**
     * @var Model
     */
    protected $model;

    /**
     * Repository constructor.
     * @param Model $model
     */
    public function __construct(Model $model)
    {
        $this->model = $model;
    }

    /**
     * @param array $data
     * @return mixed
     */
    public function create(array $data)
    {
        return $this->model->create($data);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     */
    public function all()
    {
        return $this->model->all();
    }

    /**
     * @param $id
     * @return Model
     */
    public function show($id)
    {
        return $this->model->findOrFail($id);
    }

    /**
     * @param $relations
     * @return \Illuminate\Database\Eloquent\Builder|static
     */
    public function with($relations)
    {
        return $this->model->with($relations);
    }

    /**
     * @param array $criteria
     * @return mixed
     */
    public function findAllBy(array $criteria)
    {
        $model = $this->model;

        foreach ($criteria as $column => $value) {
            $model = $model->where($column, '=', $value);
        }

        return $model->get();
    }

    /**
     * @param array $criteria
     * @return mixed
     */
    public function findOneBy(array $criteria)
    {
        $model = $this->model;

        foreach ($criteria as $column => $value) {
            $model = $model->where($column, '=', $value);
        }

        return $model->first();
    }

    /**
     * @param array $ids
     */
    public function softDelete(array $ids)
    {
        $this->model->find($ids)->each(function ($item) {
            $item->delete();
        });
    }

    public function remove($id): bool
    {
        $item   = $this->model->find($id);

        if ($item instanceof Model) {
            return $item->delete();
        }

        return false;
    }

    /**
     * @param array $data
     * @param $id
     * @return mixed
     */
    public function updateById(array $data, $id)
    {
        $record = $this->model->find($id);

        $record->update($data);

        return $record;
    }

    /**
     * @param array $data
     * @return mixed
     */
    public function findOrCreate(array $data)
    {
        $record = $this->findOneBy($data);

        if ($record) {
            return $record;
        }

        return $this->model->create($data);
    }

    /**
     * @param array $matchingData
     * @param array $data
     * @return mixed
     */
    public function updateOrCreate(array $matchingData, array $data)
    {
        return $this->model->updateOrCreate($matchingData, $data);
    }
}
