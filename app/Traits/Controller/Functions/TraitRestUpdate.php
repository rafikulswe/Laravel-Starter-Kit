<?php

namespace App\Traits\Controller\Functions;

use Illuminate\Http\Request;
use Brian2694\Toastr\Facades\Toastr;
use Exception;
use Illuminate\Validation\ValidationException;

trait TraitRestUpdate
{
    public function update(Request $request, $id)
    {
        try {
            if (!isset($this->repository)) {
                $this->errorResponse('Repository not defined');
            }

            if (isset($this->validator)) {
                // REQUEST, RULES, MESSAGES, ATTRIBUTES
                $request->validate($this->validator->rules(), $this->validator->messages(), $this->validator->attributes());
            }
            $this->repository->update($request->all(), $id);

            Toastr::success('Data Updated Successfully');
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
