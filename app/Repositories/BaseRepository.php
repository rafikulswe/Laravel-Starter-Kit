<?php

namespace App\Repositories;

use Illuminate\Database\Eloquent\Builder;

abstract class BaseRepository implements BaseRepositoryInterface
{
    protected $model;

    protected $request;

    protected $oDataService;

    protected $fieldSearchable;

    protected $orgFilterFields = ['organization_id', 'organogram_id'];

    protected function init()
    {
    }

    public function getModel()
    {
        return $this->model;
    }

    public function newQuery(): Builder
    {
        return $this->model->newQuery();
    }

    public function all()
    {
        return $this->model->all();
    }

    public function create(array $data)
    {
        return $this->model->create($data);
    }

    public function update(array $data, $id)
    {
        return $this->model->find($id)->update($data);
    }

    public function show($id, array $data = ["*"])
    {
        return $this->model->find($id, $data);
    }

    public function findById($id, array $data = ["*"])
    {
        return $this->model->find($id, $data);
    }

    public function delete($ids)
    {
        $ids = is_array($ids) ? $ids : [$ids];
        return $this->model->whereIn('id', $ids)->delete();
    }
}
