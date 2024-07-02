<?php

namespace App\Repositories;

interface BaseRepositoryInterface
{
    public function getModel();

    public function newQuery();

    public function all();

    public function create(array $data);

    public function update(array $data, int $id);

    public function show(int $id, array $data);

    public function findById(int $id, array $data);

    public function delete($ids);
}
