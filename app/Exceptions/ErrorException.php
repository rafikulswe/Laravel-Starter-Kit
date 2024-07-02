<?php

namespace App\Exceptions;

use Exception;

class ErrorException extends Exception
{
    protected $message;

    protected $code = 422;

    public function __construct($message = 'Unprocessable Entity')
    {
        $this->message = $message;
    }

    function render()
    {
        return response()->json($this->message, $this->code);
    }

}
