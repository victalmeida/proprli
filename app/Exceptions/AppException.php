<?php

namespace App\Exceptions;

use Exception;
// use Illuminate\Http\Response;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;


class AppException extends Exception
{
    public function __construct(
        string $message = '',
        int $code = 500
    ) {
        $this->message = $message;
        $this->code = $code;
    }

    public function render(Request $request): JsonResponse
    {
        return response()->json(
            [
                "data" => $this->message
            ],
            $this->code
        );
    }
}
