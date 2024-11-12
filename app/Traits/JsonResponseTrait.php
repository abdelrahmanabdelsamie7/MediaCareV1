<?php
namespace App\Traits;
trait JsonResponseTrait
{
    public function sendSuccess(string $msg, mixed $data = [], int $status = 200)
    {
        return response()->json([
            'success' => true,
            'message' => $msg,
            'data' => $data
        ], $status);
    }

    public function sendError(string $msg, mixed $data = [], int $status = 402)
    {
        return response()->json([
            'success' => false,
            'message' => $msg,
            'data' => $data
        ], $status);
    }

    public function sendNotAuth(string $msg, int $status = 403)
    {
        return response()->json([
            'success' => false,
            'message' => $msg,
        ], $status);
    }
}


