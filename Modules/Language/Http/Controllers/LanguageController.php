<?php

namespace Modules\Language\Http\Controllers;

use App\Http\Controllers\DashboardController;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Validator;
use Modules\Dashboard\Helpers\Breadcrumbs;
use Modules\Language\Entities\Language as LanguageModel;

class LanguageController extends DashboardController
{
    public function __construct()
    {
        parent::__construct();

        Breadcrumbs::setBreadcrumb(route('dashboard.language.index'), 'Языковые версии');
    }
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {
        $this->pageData['items'] = LanguageModel::getList()->get();

        $this->pageData['breadcrumbs'] = Breadcrumbs::getBreadcrumbs();

        return view('language::index', $this->pageData);
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        Breadcrumbs::setBreadcrumb(route('dashboard.language.create'), 'Новая языковая версия');

        $this->pageData['breadcrumbs'] = Breadcrumbs::getBreadcrumbs();

        return view('language::create', $this->pageData);
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'name' => 'required|min:3|max:255',
                'prefix' => 'required|unique:languages',
                'status' => 'required',
                'default' => 'required'
            ], [
                'required' => 'Поле :attribute обязательно к заполнению!',
                'min' => 'Минимальная длина поля :attribute :min символов!',
                'max' => 'Максимальная длина поля :attribute :max символов!',
                'unique' => 'Значение поля :attribute должно быть уникальным!',
            ], [
                'name' => 'Названия языковой версии',
                'prefix' => 'Префикс',
                'status' => 'Статус',
                'default' => 'По-умолчанию',
            ]);

            if($validator->fails()) {
                return redirect()->back()->withErrors($validator)->withInput();
            }

            $item = LanguageModel::createItem($request->all());

            if(!$item) {
                throw new \Exception("Не удалось создать языковую версию. Повторите попытку позже или обратитесь к администратору.");
            }

        } catch (\Exception $exception) {
            return redirect()->back()->withErrors($exception->getMessage(), 'general')->withInput();
        }

        return redirect()->route('dashboard.language.edit', ['itemId' => $item->id])->with('successMessage', "Языковая версия успешно создана!");
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit(int $id)
    {
        if(!is_numeric($id) || empty($id)) {
            abort(404);
        }

        $this->pageData['item'] = LanguageModel::getById($id);

        if(!$this->pageData['item']) {
            abort(404);
        }


        Breadcrumbs::setBreadcrumb(route('dashboard.language.edit', ['itemId' => $id]), 'Редактирование языковой версии');

        $this->pageData['breadcrumbs'] = Breadcrumbs::getBreadcrumbs();

        return view('language::edit', $this->pageData);
    }

    /**+/**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, int $id)
    {
        try {
            $validator = Validator::make($request->all(), [
                'name' => 'required|min:3|max:255',
                'prefix' => 'required|unique:languages,id,'.$id,
                'status' => 'required',
                'default' => 'required'
            ], [
                'required' => 'Поле :attribute обязательно к заполнению!',
                'min' => 'Минимальная длина поля :attribute :min символов!',
                'max' => 'Максимальная длина поля :attribute :max символов!',
                'unique' => 'Значение поля :attribute должно быть уникальным!',
            ], [
                'name' => 'Названия языковой версии',
                'prefix' => 'Префикс',
                'status' => 'Статус',
                'default' => 'По-умолчанию',
            ]);

            if($validator->fails()) {
                return redirect()->back()->withErrors($validator)->withInput();
            }

            $updated = LanguageModel::updateItem($id, $request->all());

            if(!$updated) {
                throw new \Exception("Не удалось обновить данные языковой версии. Повторите попытку позже или обратитесь к администратору");
            }

        } catch (\Exception $exception) {
            return redirect()->back()->withErrors($exception->getMessage(), 'general')->withInput();
        }

        return redirect()->route('dashboard.language.edit', ['itemId' => $id])->with('successMessage', "Языковая версия успешно обновлена!");
    }

    /**
     * Delete the specified resource from storage
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(int $id)
    {
        $response = [
            'success' => false
        ];

        if(is_numeric($id) && !empty($id)) {
            $response['success'] = LanguageModel::deleteItem($id);
        }

        return response()->json($response);
    }
}
