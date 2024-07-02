<?php

namespace App\Traits\Controller\Functions;

trait TraitRestGetByWhere
{
    public function getByWhere()
    {
        try {
            if(!isset($this->repository)){
                $this->errorResponse('Repository not defined');
            }

            $result = $this->repository->getByWhere();
            $response = isset($this->resource) ? new $this->resource($result) : $result;
            return $this->successResourceResponse($response);
        }
        catch (\Exception $e) {
            $this->errorResponse($e->getMessage());
        }
    }
}
