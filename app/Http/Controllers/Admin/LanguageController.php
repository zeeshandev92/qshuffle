<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Interfaces\AppStringRepositoryInterface;
use App\Traits\TranslateTrait;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Yajra\DataTables\Facades\DataTables;
use App\Interfaces\LanguageRepositoryInterface;
use App\Models\TranslatedString;
use App\Models\Translation;
use Illuminate\Support\Facades\DB;

class LanguageController extends Controller
{
    use TranslateTrait;

    public function __construct(
        private LanguageRepositoryInterface $languageRepository,
        private AppStringRepositoryInterface $appStringRepository,
    ) {
        $this->middleware('permission:languages-list', ['only' => ['index', 'show']]);
        $this->middleware('permission:languages-create', ['only' => ['store']]);
        $this->middleware('permission:languages-edit', ['only' => ['edit', 'update', 'change']]);
        $this->middleware('permission:languages-delete', ['only' => ['destroy']]);
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View | JsonResponse
    {
        if ($request->ajax()) {
            $data = $this->languageRepository->list();
            return DataTables::of($data)
                ->addIndexColumn()
                ->editColumn('name', function ($row) {
                    $link = route('language.show', $row->id);
                    return "<a href='{$link}'>{$row->name}</a>";
                })
                ->addColumn('action', function ($row) {
                    return view('pages.languages.actions', compact('row'));
                })->editColumn('status', function ($row) {
                    return view('pages.languages.status', compact('row'));
                })
                ->rawColumns(['name', 'action', 'status'])
                ->make(true);
        }

        return view('pages.languages.index');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        DB::beginTransaction();
        try {
            $request->validate([
                'name' => 'required',
                'locale' => 'required',
            ]);
            $data = $request->only(['name', 'locale', 'status']);
            $this->languageRepository->storeOrUpdate($data);
            DB::commit();
        } catch (\Throwable $th) {
            DB::rollback();
            return $this->redirectError($th->getMessage());
        }
        return $this->redirectSuccess(route('language.index'), 'Language created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id): View
    {
        $language = $this->languageRepository->findById($id);
        $strings = $this->appStringRepository->translationsByLanguage($id);
        return view('pages.languages.show', compact('language', 'strings'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id): RedirectResponse | View
    {
        try {
            $language = $this->languageRepository->findById($id);
            $editModal = view('pages.languages.edit', compact('language'));
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
                'name' => 'required',
                'locale' => 'required',
            ]);
            $data = $request->only(['name', 'locale', 'status']);
            $this->languageRepository->storeOrUpdate($data, $id);
            DB::commit();
        } catch (\Throwable $th) {
            DB::rollback();
            return $this->redirectError($th->getMessage());
        }
        return $this->redirectSuccess(route('language.index'), 'Language updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id): RedirectResponse
    {
        try {
            $this->languageRepository->destroyById($id);
        } catch (\Throwable $th) {
            return $this->redirectError($th->getMessage());
        }
        return  $this->redirectSuccess(route('language.index'), 'Language deleted successfully');
    }

    /**
     * Change status of resource.
     */
    public function change(Request $request, string $id)
    {
        try {
            $data = [];
            if ($request->field == 'status') {
                $data['status'] = $request->boolean('status'); // Use boolean to handle checkbox
            }
            $this->languageRepository->storeOrUpdate($data, $id);
        } catch (\Throwable $th) {
            return redirect()->back()->withErrors(['msg' => $th->getMessage()]);
        }
        return $this->redirectSuccess(route('language.index'), 'Language changed successfully.');
    }

    /**
     * Change status of resource.
     */
    public function translateStrings(string $id)
    {
        try {
            $language = $this->languageRepository->findById($id);
            $this->translateAllStrings($language->locale, $language->id);
        } catch (\Throwable $th) {
            return redirect()->back()->withErrors(['msg' => $th->getMessage()]);
        }
        return $this->redirectSuccess(route('language.show', $language->id), 'Strings translated successfully.');
    }

    /**
     * Store a newly created resource in storage.
     */

    public function updateTranslation(Request $request)
    {
        $translation = [];
        try {
            // dd($request->all());

            if ($request->translated_text && $request->id) {
                $translation = $this->languageRepository->storeOrUpdateTranslation(
                    ['translated_text' => $request->translated_text],
                    $request->id
                );
            } elseif (is_null($request->translated_text) && $request->id) {
                $result = $this->translateText($request->locale, [$request->text]);
                $translation = $this->languageRepository->storeOrUpdateTranslation(
                    ['translated_text' => $result[0]['text']],
                    $request->id
                );
            } else {
                $response = $this->translateText($request->locale, [$request->text]);
                $translation = TranslatedString::updateOrCreate([
                    'language_id' => $request->language_id,
                    'app_string_id' => $request->app_string_id,
                ], ['translated_text' => $response[0]['text']]);
                // $res = $this->createTranslations($request->language_id, $request->locale, [$request->text]);

            }
        } catch (\Throwable $th) {
            return response()->json([
                'success' => false,
                'data' => null,
                'message' => $th->getMessage(),
            ]);
        }
        return response()->json([
            'success' => true,
            'data' => $translation,
            'message' => 'Translation Update successfully'
        ]);
    }
}
