<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Invitee;
use App\Models\Question;
use App\Models\User;
use ErrorException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class InviteeController extends Controller
{
    public function index(Request $request)
    {
        try {
            //code...
            $request->validate([
                'code' => 'required',
                'type' => 'required',
            ]);
            $invitee = Invitee::with(['questions' => function ($query) use ($request) {
                return $query->where('invitee_questions.type', $request->type);
            }])->where('code', $request->code)
                ->where('status', 'accepted')->firstOrFail();

            // $data = $invitee->questions()->where('invitee_questions.type', $request->type)->get();

            return $this->apiResponse(result: $invitee, message: 'Link generated successfully.');
        } catch (\Throwable $th) {
            DB::rollBack();
            return $this->apiException($th->getMessage());
        }
    }

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
            $request->validate([
                'gender' => 'required',
                'language' => 'required',
            ]);
            DB::beginTransaction();

            $invitee = Invitee::where('code', $code)
                ->where('status', 'pending')->firstOrFail();

            if ($invitee->status == 'accepted') {
                throw new  ErrorException('Invalid Link.', 400);
            }
            $user = User::find($invitee->user_id);
            $invitee->update([
                'gender' => $request->get('gender'),
                'status' => 'accepted',
            ]);

            $questions = Question::where('relation_id', $invitee->relation_id)
                ->where('language', $request->language)->inRandomOrder()->get();

            if ($invitee->gender == $user->gender) {
                $questionIds = $questions->where('gender', $invitee->gender)
                    ->take($invitee->questions_length * 2)
                    ->pluck('id');
                $chunks = $questionIds->split(2);
                $invitee->questions()->attach($chunks->get(0), ['type' => 'invitee']);
                $invitee->questions()->attach($chunks->get(1), ['type' => 'inviter']);
            } else {
                $inviteeQuestionIds = $questions->where('gender', $invitee->gender)
                    ->take($invitee->questions_length)
                    ->pluck('id');
                $inviterQuestionIds = $questions->where('gender', $user->gender)
                    ->take($invitee->questions_length)
                    ->pluck('id');
                // dd($inviteeQuestionIds, $inviterQuestionIds);
                $invitee->questions()->attach($inviteeQuestionIds, ['type' => 'invitee']);
                $invitee->questions()->attach($inviterQuestionIds, ['type' => 'inviter']);
            }

            // dd($inviteeQuestionIds);
            DB::commit();
            return $this->apiResponse(result: null, message: 'Invitation accepted successfully.');
        } catch (\Throwable $th) {
            DB::rollBack();
            return $this->apiException($th->getMessage());
        }
    }
}
