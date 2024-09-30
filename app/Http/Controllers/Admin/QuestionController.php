<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Interfaces\QuestionRepositoryInterface;
use App\Interfaces\RelationRepositoryInterface;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class QuestionController extends Controller
{
    public function __construct(
        private RelationRepositoryInterface $relationRepository,
        private QuestionRepositoryInterface $questionRepository,
    ) {
        $this->middleware('permission:questions-list', ['only' => ['index', 'show']]);
        $this->middleware('permission:questions-create', ['only' => ['store']]);
        $this->middleware('permission:questions-edit', ['only' => ['edit', 'update', 'change']]);
        $this->middleware('permission:questions-delete', ['only' => ['destroy']]);
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View | JsonResponse
    {
        if ($request->ajax()) {
            $data = $this->questionRepository->list();
            return DataTables::of($data)
                ->addIndexColumn()
                ->editColumn('relation', function ($row) {
                    return $row->relation->title;
                })
                ->addColumn('action', function ($row) {
                    return view('pages.questions.action', compact('row'));
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        return view('pages.questions.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        $relations = $this->relationRepository->activeList();
        return view('pages.questions.create', compact('relations'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        try {
            $validatedReq = $request->validate([
                'relation_id' => 'required',
                'gender' => 'required',
                'question' => 'required',
                'type' => 'required',
                'choices' => 'array|required_if:type,in:multiple_choice'
            ]);

            $this->questionRepository->storeOrUpdate($validatedReq);

            return $this->redirectBackWithSuccess('Data Saved Successfully.');
        } catch (\Throwable $th) {
            //throw $th;
            return $this->redirectError($th->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id): View
    {
        $relations = $this->relationRepository->activeList();
        $question = $this->questionRepository->findById($id);
        return view('pages.questions.edit', compact('relations', 'question'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id): RedirectResponse
    {
        try {
            $validatedReq = $request->validate([
                'relation_id' => 'required',
                'gender' => 'required',
                'question' => 'required',
                'type' => 'required',
                'choices' => 'array|required_if:type,in:multiple_choice'
            ]);

            if ($request->type == 'free_text') {
                $validatedReq['choices'] = null;
            }

            $this->questionRepository->storeOrUpdate($validatedReq, $id);

            return $this->redirectSuccess(route('questions.index'), 'Data Updated Successfully.');
        } catch (\Throwable $th) {
            //throw $th;
            return $this->redirectError($th->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id): RedirectResponse
    {
        try {
            $this->questionRepository->destroyById($id);
        } catch (\Throwable $th) {
            return $this->redirectError($th->getMessage());
        }
        return  $this->redirectSuccess(route('questions.index'), 'Data deleted successfully');
    }
}
