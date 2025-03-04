<?php

namespace App\Services\system;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\JsonResponse;

class SystemApiResponseServices
{
    static function ReturnSuccess(array|Collection|SupportCollection|JsonResponse $data, string|array|null $message)
    {
        // Check if $data is a JsonResponse and extract the original data
        if ($data instanceof JsonResponse) {
            $data = $data->getData(true);
        }

        return response()->json([
            "code" => 200,
            "data" => $data,
            "message" => $message,
        ]);
    }

    static function ReturnFailed(array|Collection $data, string|array|null $message)
    {
        return response()->json([
            "code" => 404,
            "data" => $data,
            "message" => $message,
        ]);
    }

    static function ReturnError(int $code, array|Collection|null $data, string|null $message)
    {
        return response()->json([
            "code" => $code,
            "data" => $data,
            "message" => $message,
        ]);
    }
}
