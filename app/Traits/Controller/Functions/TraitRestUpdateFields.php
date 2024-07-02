<?php

namespace App\Traits\Controller\Functions;

use App\Exceptions\ValidatorException;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

trait TraitRestUpdateFields
{
    public function updateFields(Request $request, $id)
    {
        try {
            if(!isset($this->repository)){
                $this->errorResponse('Repository not defined');
            }

            $partialUpdateFields = isset($this->partialUpdateFields) ?  $request->only($this->partialUpdateFields) : [];
            $rules = $this->validator->rules();
            $updatedRules = [];
            foreach ($partialUpdateFields AS $key => $value) {
                if (isset($rules[$key])) {
                    $updatedRules[$key] = $rules[$key];
                }
            }

            if (isset($this->validator)) {
                $this->validate($request, $updatedRules, $this->validator->messages());
            }

            $response = $this->repository->update($partialUpdateFields, $id);
            return $this->successResponse($response);
        }
        catch (ValidationException $e) {
            throw new ValidatorException($e);
        }
        catch (\Exception $e) {
            $this->errorResponse($e->getMessage());
        }
    }
}
