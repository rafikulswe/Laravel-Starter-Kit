<?php

namespace App\Traits\Controller\Functions;

trait TraitRestIndex
{
    public function index()
    {
        try {
            if (!isset($this->repository)) {
                $this->errorResponse('Repository not defined');
            }

            $result = $this->repository->list();
            $result['results'] = isset($this->resource) ? $this->resource::collection($result['results']) : $result['results'];
            return $this->successResourceCollectionResponse($result);
        } catch (\Exception $e) {
            $this->errorResponse($e->getMessage());
        }
    }
}
