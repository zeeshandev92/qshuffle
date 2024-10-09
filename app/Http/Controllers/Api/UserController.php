<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index(): JsonResponse
    {
        try {
            $user = User::with('relation')->find(auth()->user()->id);
            $user->makeHidden('email', 'email_verified_at', 'type', 'created_at', 'updated_at');
            return $this->apiResponse(result: $user, message: 'User get successfully.');
        } catch (\Throwable $th) {
            return $this->apiException($th->getMessage());
        }
    }


    public function update(Request $request, $id): JsonResponse
    {
        try {
            $request->validate([
                'gender' => 'required',
                'relation_id' => 'required',
            ]);
            $user = User::find($id);
            $user = $user->update([
                'gender' => $request->gender,
                'relation_id' => $request->relation_id
            ]);

            return $this->apiResponse(result: null, message: 'Profile updated successfully.');
        } catch (\Throwable $th) {
            return $this->apiException($th->getMessage());
        }
    }
}
