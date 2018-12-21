<?php

namespace App\Repositories\Contracts;

interface RepositoryInterface
{
    /**
     * @param array $data
     * @return mixed
     */
    public function create(array $data);

    /**
     * @return mixed
     */
    public function all();

    /**
     * @param $id
     * @return mixed
     */
    public function show($id);

    /**
     * @param $relations
     * @return mixed
     */
    public function with($relations);
}
