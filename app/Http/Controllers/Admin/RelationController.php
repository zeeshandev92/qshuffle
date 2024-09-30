<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Interfaces\RelationRepositoryInterface;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class RelationController extends Controller
{
    public function __construct(
        private RelationRepositoryInterface $relationRepository,
    ) {
        $this->middleware('permission:relations-list', ['only' => ['index', 'show']]);
        $this->middleware('permission:relations-create', ['only' => ['store']]);
        $this->middleware('permission:relations-edit', ['only' => ['edit', 'update', 'change']]);
        $this->middleware('permission:relations-delete', ['only' => ['destroy']]);
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = $this->relationRepository->list();
            return DataTables::of($data)
                ->addIndexColumn()
                ->editColumn('status', function ($row) {
                    return $row->status? 'Active' : 'InActive' ;
                })
                ->addColumn('action', function ($row) {
                    return view('pages.relations.actions', compact('row'));
                })/* ->editColumn('status', function ($row) {
                    return view('pages.relations.status', compact('row'));
                }) */
                ->rawColumns(['action'])
                ->make(true);
        }
        return view('pages.relations.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        return view('pages.relations.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        try {
            $request->validate([
                'title' => 'required',
            ]);
            $data = $request->only(['title', 'status']);
            $this->relationRepository->storeOrUpdate($data);
        } catch (\Throwable $th) {
            return $this->redirectError($th->getMessage());
        }
        return $this->redirectSuccess(route('relations.index'), 'Data created successfully.');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id): RedirectResponse|View
    {
        try {
            $category = $this->relationRepository->findById($id);
            $editModal = view('pages.relations.edit', compact('category'));
        } catch (\Throwable $th) {
            return $this->redirectError($th->getMessage());
        }
        return $editModal;
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id): RedirectResponse
    {
        try {
            $request->validate([
                'title' => 'required',
            ]);
            $data = $request->only(['title', 'status']);
            $this->relationRepository->storeOrUpdate($data, $id);
        } catch (\Throwable $th) {
            return $this->redirectError($th->getMessage());
        }
        return $this->redirectSuccess(route('relations.index'), 'Data updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id): RedirectResponse
    {
        try {
            $this->relationRepository->destroyById($id);
        } catch (\Throwable $th) {
            return $this->redirectError($th->getMessage());
        }
        return  $this->redirectSuccess(route('relations.index'), 'Data deleted successfully');
    }

    public function change(Request $request, string $id)
    {
        try {
            $data = [];
            if ($request->field == 'status') {
                $data['status'] = $request->boolean('status'); // Use boolean to handle checkbox
            }
            $this->relationRepository->storeOrUpdate($data, $id);
        } catch (\Throwable $th) {
            return redirect()->back()->withErrors(['msg' => $th->getMessage()]);
        }
        return $this->redirectSuccess(route('relations.index'), 'Data changed successfully.');
    }
}
