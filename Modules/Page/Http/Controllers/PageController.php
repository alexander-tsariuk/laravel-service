<?php

namespace Modules\Page\Http\Controllers;

use App\Http\Controllers\DashboardController;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Modules\Language\Entities\Language as LanguageModel;
use Modules\Page\Entities\Page as PageModel;
use Modules\Page\Entities\PageTranslation as PageTranslationModel;
use Illuminate\Support\Facades\Validator;

class PageController extends DashboardController
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {
        $this->pageData['items'] = PageModel::getList()->paginate(10);

        return view('page::index', $this->pageData);
    }

    public function create()
    {
        $this->pageData['languages'] = LanguageModel::getList()->get();

        return view('page::create', $this->pageData);
    }

    public function store(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'prefix' => 'required|unique:pages',
                'status' => 'required',
                'translation.*.name' => 'required|min:3|max:255'
            ], [
                'required' => 'Поле :attribute обязательно к заполнению!',
                'min' => 'Минимальная длина поля :attribute :min символов!',
                'max' => 'Максимальная длина поля :attribute :max символов!',
                'unique' => 'Значение поля :attribute должно быть уникальным!',
            ], [
                'translation.*.name' => 'Название страницы',
                'status' => 'Статус',
                'translation.*.description' => 'Описание',
            ]);

            if($validator->fails()) {
                return response()->redirectToRoute('dashboard.page.create')->withErrors($validator->errors())->withInput();
            }

            $item = PageModel::createItem($request->all());

            if(!$item) {
                throw new \Exception("При создании страницы произошла ошибка. Повторите попытку позже или обратитесь к администратору!");
            }

            if(!PageTranslationModel::createTranslations($item->id, $request->get('translation'))) {
                throw new \Exception("При создании переводов страницы произошла ошибка. Повторите попытку позже или обратитесь к администратору!");
            }
        } catch (\Exception $exception) {
            return redirect()->back()->withErrors($exception->getMessage(), 'general')->withInput();
        }

        return response()->redirectToRoute('dashboard.page.edit', ['itemId' => $item->id])
            ->with('successMessage', "Страница была успешно добавлена!");
    }

    public function edit(int $id)
    {
        if(!is_numeric($id) || empty($id)) {
            abort(404);
        }

        $this->pageData['item'] = PageModel::find($id);

        if(!$this->pageData['item']) {
            abort(404);
        }

        $this->pageData['item']->preparedTranslations = $this->pageData['item']->prepareTranslationsByID();

        $this->pageData['languages'] = LanguageModel::getList()->get();

        return view('page::edit', $this->pageData);
    }

    public function update(Request $request, int $id)
    {
        try {
            $validator = Validator::make($request->all(), [
                'prefix' => 'required|unique:pages,id,'.$id,
                'status' => 'required',
                'translation.*.name' => 'required|min:3|max:255'
            ], [
                'required' => 'Поле :attribute обязательно к заполнению!',
                'min' => 'Минимальная длина поля :attribute :min символов!',
                'max' => 'Максимальная длина поля :attribute :max символов!',
                'unique' => 'Значение поля :attribute должно быть уникальным!',
            ], [
                'translation.*.name' => 'Название страницы',
                'status' => 'Статус',
                'translation.*.description' => 'Описание',
            ]);

            if($validator->fails()) {
                return response()->redirectToRoute('dashboard.page.edit', ['itemId' => $id])->withErrors($validator->errors())->withInput();
            }

            $item = PageModel::updateItem($id, $request->all());

            if(!$item) {
                throw new \Exception("При создании страницы произошла ошибка. Повторите попытку позже или обратитесь к администратору!");
            }

            if(!PageTranslationModel::updateTranslations($id, $request->get('translation'))) {
                throw new \Exception("При обновлении переводов страницы произошла ошибка. Повторите попытку позже или обратитесь к администратору!");
            }
        } catch (\Exception $exception) {
            return redirect()->back()->withErrors($exception->getMessage(), 'general')->withInput();
        }

        return response()->redirectToRoute('dashboard.page.edit', ['itemId' => $id])
            ->with('successMessage', "Страница была успешно обновлена!");
    }

    public function destroy($id)
    {
        $response = [
            'success' => false
        ];

        if(is_numeric($id) && !empty($id)) {
            $response['success'] = PageModel::deleteItem($id);
        }

        return response()->json($response);
    }
}
