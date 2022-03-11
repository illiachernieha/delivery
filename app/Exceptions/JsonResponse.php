<?php

namespace App\Exceptions;

use Illuminate\Http\Response;

trait JsonResponse
{
    public function getModelJsonResponseException(): \Illuminate\Http\JsonResponse
    {
        return response()->json([
            'data' => [
                'message' => 'Model not found',
                'status_code' => Response::HTTP_NOT_FOUND
            ]
        ], Response::HTTP_NOT_FOUND);
    }
    public function getHttpJsonResponseException(): \Illuminate\Http\JsonResponse
    {
        return response()->json([
            'data' => [
                'message' => 'Endpoint not found',
                'status_code' => Response::HTTP_NOT_FOUND
            ]
        ], Response::HTTP_NOT_FOUND);
    }
    public function getBadRequestJsonResponseException($e): \Illuminate\Http\JsonResponse
    {
        return response()->json([
            'data' => [
                'message' => $e->getMessage(),
                'status_code' => Response::HTTP_BAD_REQUEST
            ]
        ], Response::HTTP_BAD_REQUEST);
    }
    public function getValidationJsonResponseException($e): \Illuminate\Http\JsonResponse
    {
        return response()->json([
            'data' => [
                'message' => $e->errors(),
                'status_code' => Response::HTTP_BAD_REQUEST
            ]
        ], Response::HTTP_BAD_REQUEST);
    }
}
