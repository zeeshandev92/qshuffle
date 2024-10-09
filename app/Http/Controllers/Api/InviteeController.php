<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Invitee;
use ErrorException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class InviteeController extends Controller
{

    public function store(Request $request): JsonResponse
    {
        try {
            DB::beginTransaction();

            $invitee = Invitee::create([
                'user_id' => auth()->user()->id,
                'relation_id' => auth()->user()->relation_id,
                'questions_length' => $request->questions_length
            ]);

            $link = url()->query('/invite', ['code' => $invitee->code]);

            DB::commit();
            return $this->apiResponse(result: $link, message: 'Link generated successfully.');
        } catch (\Throwable $th) {
            DB::rollBack();
            return $this->apiException($th->getMessage());
        }
    }

    public function update(Request $request, $code): JsonResponse
    {
        try {
            DB::beginTransaction();

            $invitee = Invitee::where('code', $code)
                ->where('status', 'pending')->first();

            if ($invitee->status == 'pending') {
                throw new  ErrorException('Invalid Link.', 400);
            }

            $invitee->update([
                'gender' => $request->get('gender'),
                'status' => 'accepted',
            ]);

            DB::commit();
            return $this->apiResponse(result: null, message: 'Invitation accepted successfully.');
        } catch (\Throwable $th) {
            DB::rollBack();
            return $this->apiException($th->getMessage());
        }
    }
}
