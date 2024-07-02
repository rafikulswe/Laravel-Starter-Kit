<?php

namespace App\Traits\Controller\Functions;

trait TraitRestDestroy
{
    public function destroy($id)
    {
        try {
            if (!isset($this->repository)) {
                $this->errorResponse('Repository not defined');
            }

            $entity = $this->repository->findById($id);
            if (empty($entity)) {
                return $this->notFoundResponse('Data not found');
            }

            $executeResponse = $this->repository->delete($id);
            if (!$executeResponse) {
                $this->errorResponse();
            }
            return $this->deleteResponse();
        } catch (\Exception $e) {
            $this->errorResponse($e->getMessage());
        }
    }
}
