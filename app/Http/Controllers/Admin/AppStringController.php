<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Yajra\DataTables\Facades\DataTables;
use App\Interfaces\AppStringRepositoryInterface;
use Illuminate\Support\Facades\DB;

class AppStringController extends Controller
{
    public function __construct(
        private AppStringRepositoryInterface $appStringRepository,
    ) {
        $this->middleware('permission:appString-list', ['only' => ['index', 'show']]);
        $this->middleware('permission:appString-create', ['only' => ['store']]);
        $this->middleware('permission:appString-edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:appString-delete', ['only' => ['destroy']]);

    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): JsonResponse | View
    {
        if ($request->ajax()) {
            $data = $this->appStringRepository->list();
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    return view('pages.app-strings.actions', compact('row'));
                })
                ->rawColumns(['action'])
                ->make(true);
        }

        return view('pages.app-strings.index');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {
    DB::beginTransaction();
        // try {
            $request->validate([
                'key' => 'required',
                'text' => 'required',
            ]);
            $data = $request->only(['key', 'text']);
            $this->appStringRepository->storeOrUpdate($data);
            DB::commit();
        // } catch (\Throwable $th) {
        //     DB::rollback();
        //     return $this->redirectError($th->getMessage());
        // }

        return $this->redirectSuccess(route('app-strings.index'), 'String created successfully.');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id): RedirectResponse | View
    {
        try {
            $string = $this->appStringRepository->findById($id);
            $editModal = view('pages.app-strings.edit', compact('string'));
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
        DB::beginTransaction();
        try {
            $request->validate([
                'key' => 'required',
                'text' => 'required',
            ]);
            $data = $request->only(['key', 'text']);
            $this->appStringRepository->storeOrUpdate($data, $id);
            DB::commit();
        } catch (\Throwable $th) {
            DB::rollback();
            return $this->redirectError($th->getMessage());
        }
        return $this->redirectSuccess(route('app-strings.index'), 'String updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id): RedirectResponse
    {
        try {
            $this->appStringRepository->destroyById($id);
        } catch (\Throwable $th) {
            return $this->redirectError($th->getMessage());
        }
        return  $this->redirectSuccess(route('app-strings.index'), 'String deleted successfully');
    }
}
