<?php

namespace App\Repositories;

use App\Models\Example;

class ExampleRepository extends BaseRepository
{
    /**
     * @var Example
     */
    protected $model;

    protected $request;

    protected $oDataService;

    protected $fieldSearchable = ['title', 'description'];

    public function __construct()
    {
        $this->model = new Example();
    }

    protected function init()
    {
        $this->request = request();
    }

    public function listData($search, $paginate)
    {
        return $this->newQuery()
            ->latest()
            ->where(function ($query) use ($search) {
                $query->orWhere('title', 'LIKE', '%' . $search . '%');
                $query->orWhere('description', 'LIKE', '%' . $search . '%');
            })
            ->paginate($paginate->perPage);
    }
}
