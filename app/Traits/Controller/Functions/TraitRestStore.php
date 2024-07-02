<?php

namespace App\Traits\Controller\Functions;

use Brian2694\Toastr\Facades\Toastr;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

trait TraitRestStore
{
    public function store(Request $request)
    {
        try {
            if (!isset($this->repository)) {
                $this->errorResponse('Repository not defined');
            }

            if (isset($this->validator)) {
                // REQUEST, RULES, MESSAGES, ATTRIBUTES
                $request->validate($this->validator->rules(), $this->validator->messages(), $this->validator->attributes());
            }
            $this->repository->create($request->all());
            Toastr::success('Data Inserted Successfully');
            return redirect()->back();
        } catch (ValidationException $e) {
            $messages = $this->validator->messages();
            foreach ($messages as $message) {
                Toastr::error($message, 'Failed', ['timeOut' => 10000]);
            }
            return redirect()->back()->withErrors($this->validator);
        } catch (Exception $e) {
            Toastr::error('An unexpected error occurred: ' . $e->getMessage(), 'Failed', ['timeOut' => 10000]);
            return redirect()->back()->withErrors($this->validator);
        }
    }
}
