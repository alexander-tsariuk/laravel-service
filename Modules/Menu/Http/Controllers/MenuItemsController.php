<?php

namespace Modules\Menu\Http\Controllers;

use App\Http\Controllers\DashboardController;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Modules\Dashboard\Helpers\Breadcrumbs;
use Modules\Language\Entities\Language as LanguageModel;
use Modules\Menu\Entities\Menu as MenuModel;
use Modules\Menu\Entities\MenuItems as MenuItemsModel;
use Modules\Menu\Entities\MenuItemTranslations as MenuItemTranslationsModel;

class MenuItemsController extends DashboardController
{
    public function __construct()
    {
        parent::__construct();
        Breadcrumbs::setBreadcrumb(route('dashboard.menu.index'), 'Меню сайта');
    }

    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index(int $id)
    {
        if(!is_numeric($id) || empty($id)) {
            abort(404);
        }

        $this->pageData['items'] = MenuItemsModel::getList($id)->paginate(10);

        Breadcrumbs::setBreadcrumb(route('dashboard.menu.items.index', ['itemId' => $id]), 'Элементы меню сайта');
        $this->pageData['breadcrumbs'] = Breadcrumbs::getBreadcrumbs();
        $this->pageData['title'] = 'Элементы меню сайта';
        $this->pageData['itemId'] = $id;

        return view('menu::items.index', $this->pageData);
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create(int $id)
    {
        Breadcrumbs::setBreadcrumb(route('dashboard.menu.items.index', ['itemId' => $id]), 'Элементы меню сайта');
        Breadcrumbs::setBreadcrumb(route('dashboard.menu.items.create', ['itemId' => $id]), 'Новый элемент меню сайта');

        $this->pageData['breadcrumbs'] = Breadcrumbs::getBreadcrumbs();
        $this->pageData['title'] = 'Новый элемент меню сайта';
        $this->pageData['itemId'] = $id;
        $this->pageData['languages'] = LanguageModel::getList()->get();
        $this->pageData['menus'] = MenuModel::getList()->get();
        $this->pageData['menuItems'] = MenuItemsModel::getList($id)->get();

        return view('menu::items.create', $this->pageData);
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(Request $request, int $menuId)
    {
        try {
            $validator = Validator::make($request->all(), [
                'menuId' => 'required|integer',
                'status' => 'required',
                'url' => 'required',
                'translation.*.label' => 'required|min:2|max:255'
            ], [
                'required' => 'Поле :attribute обязательно к заполнению!',
                'min' => 'Минимальная длина поля :attribute :min символов!',
                'max' => 'Максимальная длина поля :attribute :max символов!',
                'unique' => 'Значение поля :attribute должно быть уникальным!',
            ], [
                'name' => 'Название меню',
                'code' => 'Код меню',
                'status' => 'Статус',
            ]);

            if($validator->fails()) {
                return redirect()->back()->withErrors($validator)->withInput();
            }

            $item = MenuItemsModel::createItem($menuId, $request->all());

            if(!$item) {
                throw new \Exception("Не удалось создать элемент меню. Повторите попытку позже или обратитесь к администратору.");
            }

            if(!MenuItemTranslationsModel::createTranslations($item->id, $request->get('translation'))) {
                throw new \Exception("При создании элемента меню произошла ошибка. Повторите попытку позже или обратитесь к администратору!");
            }
        } catch (\Exception $exception) {
            return redirect()->back()->with('errorMessage', $exception->getMessage())->withInput();
        }

        return redirect()->route('dashboard.menu.items.index', ['itemId' => $menuId])->with('successMessage', "Элемент меню успешно создан!");
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit(int $menuId, int $id)
    {
        if(!is_numeric($id) || empty($id)) {
            abort(404);
        }

        if(!is_numeric($menuId) || empty($menuId)) {
            abort(404);
        }

        $this->pageData['item'] = MenuItemsModel::find($id);

        if(!$this->pageData['item']) {
            abort(404);
        }

        $this->pageData['item']->preparedTranslations = $this->pageData['item']->prepareTranslationsByID();

        Breadcrumbs::setBreadcrumb(route('dashboard.menu.items.index', ['itemId' => $menuId]), 'Элементы меню сайта');
        Breadcrumbs::setBreadcrumb(route('dashboard.menu.items.edit', ['itemId' => $menuId, 'elementId' => $id]), 'Редактирование элемента меню сайта');

        $this->pageData['breadcrumbs'] = Breadcrumbs::getBreadcrumbs();
        $this->pageData['title'] = 'Редактирование элемента меню сайта';
        $this->pageData['itemId'] = $menuId;
        $this->pageData['languages'] = LanguageModel::getList()->get();

        $this->pageData['menus'] = MenuModel::getList()->get();
        $this->pageData['menuItems'] = MenuItemsModel::getList($id)->get();

        return view('menu::items.edit', $this->pageData);
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Renderable
     */
    public function update(Request $request, int $menuId, $elementId)
    {
        try {
            $validator = Validator::make($request->all(), [
                'menuId' => 'required|integer',
                'status' => 'required',
                'url' => 'required',
                'translation.*.label' => 'required|min:2|max:255'
            ], [
                'required' => 'Поле :attribute обязательно к заполнению!',
                'min' => 'Минимальная длина поля :attribute :min символов!',
                'max' => 'Максимальная длина поля :attribute :max символов!',
                'unique' => 'Значение поля :attribute должно быть уникальным!',
            ], [
                'name' => 'Название меню',
                'code' => 'Код меню',
                'status' => 'Статус',
            ]);

            if($validator->fails()) {
                return redirect()->back()->withErrors($validator)->withInput();
            }

            $updated = MenuItemsModel::updateItem($elementId, $request->all());

            if(!$updated) {
                throw new \Exception("Не удалось обновить данные элемента меню. Повторите попытку позже или обратитесь к администратору");
            }

            if(!MenuItemTranslationsModel::updateTranslations($elementId, $request->get('translation'))) {
                throw new \Exception("При обновлении переводов элемента меню произошла ошибка. Повторите попытку позже или обратитесь к администратору!");
            }
        } catch (\Exception $exception) {
            return redirect()->back()->with('errorMessage', $exception->getMessage())->withInput();
        }

        return redirect()->route('dashboard.menu.items.edit', ['itemId' => $menuId, 'elementId' => $elementId])->with('successMessage', "Элемент меню успешно обновлен!");
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Renderable
     */
    public function destroy($id)
    {
//        $response = [
//            'success' => false
//        ];
//
//        if(is_numeric($id) && !empty($id)) {
//            $response['success'] = MenuModel::deleteItem($id);
//        }
//
//        return response()->json($response);
    }
}
