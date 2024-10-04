<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;

    public function redirectSuccess($route, $message)
    {
        return redirect($route)->with('success', $message);
    }


    public function redirectBackWithSuccess($message)
    {
        return back()->with('success', $message);
    }

    public function redirectError($message): RedirectResponse
    {
        return back()->withErrors(['msg' => $message]);
    }

    public function apiResponse($result = null, bool $success = true,  string $message = null, int $code = 200): JsonResponse
    {
        $response = [
            'success' => $success,
            'data'    => $result,
            'message' => $message,
        ];
        return response()->json($response, $code);
    }

    public function apiException($errors, int $code = 500): JsonResponse
    {
        $response = [
            'success' => false,
            'message' => 'Exception occurred.',
            'exception' => $errors
        ];
        return response()->json($response, $code);
    }
}
