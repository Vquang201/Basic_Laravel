<?php

namespace App\Helpers;

use Illuminate\Http\Response;



class ResponseHelper
{

    public static function success($message, $statusCode = 200)
    {
        return response()->json(['success' => $message], $statusCode);
    }

    public static function error($message, $statusCode = 400)
    {
        return response()->json(['error' => $message], $statusCode);
    }
}
