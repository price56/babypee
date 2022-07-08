<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Http\JsonResponse;

class ApiException extends Exception
{
    public function __construct(public $message, public $statusCode = 400)
    {
    }

    public function render(): JsonResponse
    {
        return response()->json([
            'message' => $this->message,
            'code' => $this->statusCode,
        ], $this->statusCode, [], JSON_THROW_ON_ERROR);
    }
}
