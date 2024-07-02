<?php

namespace App\Traits\Controller\Functions;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Exceptions\ErrorException;
use App\Exceptions\ValidatorException;
use Illuminate\Validation\ValidationException;

trait TraitRestBulk
{
    public function bulk(Request $request)
    {
        try {
            DB::beginTransaction();

            if (!isset($this->repository)) {
                $this->errorResponse('Repository not defined');
            }

            $action = $request->post('action', 'boolean_update');
            $ids = $request->post('ids');
            $field = $request->post('field', 'status');
            $value = $request->post('value', 1);
            $primaryKey = $request->post('primary_key', 'id');
            if (!is_array($ids)) {
                throw new ErrorException('Please select item(s)');
            }

            $response = '';
            switch ($action) {
                case 'update_boolean':
                    $response = $this->repository->multiUpdate($primaryKey, $ids, [$field => $value]);
                    break;
                case 'active':
                    $response = $this->repository->multiUpdate($primaryKey, $ids, ['status' => 1]);
                    break;
                case 'inactive':
                    $response = $this->repository->multiUpdate($primaryKey, $ids, ['status' => 0]);
                    break;
                case 'delete':
                    $response = $this->repository->delete($ids);
                    break;
            }

            DB::commit();
            return $this->successResponse($response);
        } catch (ValidationException $e) {
            DB::rollBack();
            throw new ValidatorException($e);
        } catch (\Exception $e) {
            DB::rollBack();
            $this->errorResponse($e->getMessage());
        }
    }
}
