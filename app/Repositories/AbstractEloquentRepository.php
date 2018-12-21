<?php

namespace App\Repositories;

use Carbon\Carbon;
use Illuminate\Database\Query\Builder;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

abstract class AbstractEloquentRepository
{
    abstract protected function getTableName(): string;

    abstract protected function getModelClass(): string;

    public function findAll()
    {
        $collection = new Collection();
        $modelClass = $this->getModelClass();

        $results = $this
            ->getQueryBuilder()
            ->get()
            ->all();

        foreach ($results as $result) {
            $attributes = (array)$result;
            $entity = new $modelClass($attributes);

            $collection->push($entity);
        }

        return $collection;
    }

    public function findAllBy(array $criteria)
    {
        $collection = new Collection();
        $queryBuilder = $this->getQueryBuilder();
        $modelClass = $this->getModelClass();

        foreach ($criteria as $field => $value) {
            $queryBuilder = $queryBuilder->where($field, '=', $value);
        }

        $results = $queryBuilder
            ->get()
            ->all();

        foreach ($results as $result) {
            $attributes = (array)$result;
            $entity = new $modelClass($attributes);

            $collection->push($entity);
        }

        return $collection;
    }

    /**
     * @param array $criteria
     * @return null
     */
    public function findOneBy(array $criteria)
    {
        $queryBuilder = $this->getQueryBuilder();

        foreach ($criteria as $field => $value) {
            $queryBuilder = $queryBuilder->where($field, '=', $value);
        }

        $result = $queryBuilder->first();

        if (is_null($result)) {
            return null;
        }

        $modelClass = $this->getModelClass();
        $attributes = (array)$result;

        return new $modelClass($attributes);
    }

    public function save($entity)
    {
        $primaryKey = $entity->getKeyName();

        $matching = [
            $primaryKey => $entity->getKey(),
        ];

        return $this->updateOrCreate($entity->getAttributes(), $matching);
    }

    protected function getQueryBuilder(): Builder
    {
        return DB::table($this->getTableName());
    }

    protected function updateOrCreate(array $attributes, array $matching)
    {
        $data = $attributes;
        $now = (new Carbon())->format('Y-m-d H:i:s');

        if (!isset($attributes['created_at'])) {
            $data['created_at'] = $now;
        }

        if (!isset($attributes['updated_at'])) {
            $data['updated_at'] = $now;
        }

        $this
            ->getQueryBuilder()
            ->updateOrInsert($matching, $data);

        return $this->findOneBy($attributes);
    }

    public function findAllIn(string $column, array $values)
    {
        $collection = new Collection();
        $queryBuilder = $this->getQueryBuilder();
        $modelClass = $this->getModelClass();

        $queryBuilder = $queryBuilder->whereIn($column, $values);

        $results = $queryBuilder
            ->get()
            ->all();

        foreach ($results as $result) {
            $attributes = (array)$result;
            $entity = new $modelClass($attributes);

            $collection->push($entity);
        }

        return $collection;
    }

    //todo: name, pls
    public function findAllWithColumns(array $columns)
    {
        foreach ($columns as $column => $label) {
            $dbAliasSelect[] = $column . ' as ' . $label;
        }

        $results = $this
            ->getQueryBuilder()
            ->get($dbAliasSelect);

        return $results;
    }
}
