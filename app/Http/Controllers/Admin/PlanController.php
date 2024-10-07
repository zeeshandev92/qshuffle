<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Interfaces\PlanRepositoryInterface;
use App\Interfaces\RelationRepositoryInterface;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;;

class PlanController extends Controller
{

    public function __construct(
        private PlanRepositoryInterface $planRepository,
    ) {
        $this->middleware('permission:plans-list', ['only' => ['index', 'show']]);
        $this->middleware('permission:plans-create', ['only' => ['store']]);
        $this->middleware('permission:plans-edit', ['only' => ['edit', 'update', 'change']]);
        $this->middleware('permission:plans-delete', ['only' => ['destroy']]);
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View | JsonResponse
    {
        if ($request->ajax()) {
            $data = $this->planRepository->list();
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    return view('pages.plans.action', compact('row'));
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        return view('pages.plans.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        return view('pages.plans.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        try {
            $request->validate([
                'title' => 'required',
                'charges' => 'required',
                'type' => 'required',
            ]);

            $this->planRepository->storeOrUpdate($request->only(['title', 'charges', 'type', 'description', 'bullets', 'status']));

            return $this->redirectSuccess(route('plans.index'), 'Data Saved Successfully.');
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
        $plan = $this->planRepository->findById($id);
        return view('pages.plans.edit', compact('plan'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id): RedirectResponse
    {
        try {
            $request->validate([
                'title' => 'required',
                'charges' => 'required',
                'type' => 'required',
            ]);

            $this->planRepository->storeOrUpdate($request->only(['title', 'charges', 'type', 'description', 'bullets', 'status']), $id);

            return $this->redirectSuccess(route('plans.index'), 'Data Updated Successfully.');
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
            $this->planRepository->destroyById($id);
        } catch (\Throwable $th) {
            return $this->redirectError($th->getMessage());
        }
        return  $this->redirectSuccess(route('plans.index'), 'Data deleted successfully');
    }
}
