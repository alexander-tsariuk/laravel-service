<?php

namespace Modules\Menu\Http\Controllers;

use App\Http\Controllers\DashboardController;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Modules\Dashboard\Helpers\Breadcrumbs;
use Modules\Menu\Entities\Menu as MenuModel;
use Modules\Menu\Entities\MenuItems as MenuItemsModel;

class MenuController extends DashboardController
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
    public function index()
    {
        $this->pageData['items'] = MenuModel::getList()->paginate(10);

        $this->pageData['breadcrumbs'] = Breadcrumbs::getBreadcrumbs();
        $this->pageData['title'] = 'Меню сайта';

        $this->pageData['additionalButtons'] = [];
        $this->pageData['additionalButtons'][0] = [
            'colorClass' => 'btn-success',
            'title' => "Список элементов",
            'iconClass' => 'fas fa-bars'
        ];

        return view('menu::index', $this->pageData);
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        Breadcrumbs::setBreadcrumb(route('dashboard.menu.create'), 'Новое меню сайта');
        $this->pageData['breadcrumbs'] = Breadcrumbs::getBreadcrumbs();
        $this->pageData['title'] = 'Новое меню сайта';
        return view('menu::create', $this->pageData);
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'name' => 'required|min:3|max:255',
                'code' => 'required|unique:menus',
                'status' => 'required',
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

            $item = MenuModel::createItem($request->all());

            if(!$item) {
                throw new \Exception("Не удалось создать меню. Повторите попытку позже или обратитесь к администратору.");
            }

        } catch (\Exception $exception) {
            return redirect()->back()->with('errorMessage', $exception->getMessage())->withInput();
        }

        return redirect()->route('dashboard.menu.index')->with('successMessage', "Меню успешно создано. Теперь Вы можете добавить элементы меню.");
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit($id)
    {
        if(!is_numeric($id) || empty($id)) {
            abort(404);
        }

        $this->pageData['item'] = MenuModel::find($id);

        if(!$this->pageData['item']) {
            abort(404);
        }

        Breadcrumbs::setBreadcrumb(route('dashboard.menu.edit', ['itemId' => $id]), 'Редактирование меню сайта');
        $this->pageData['breadcrumbs'] = Breadcrumbs::getBreadcrumbs();
        $this->pageData['title'] = 'Редактирование меню сайта';

        return view('menu::edit', $this->pageData);
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Renderable
     */
    public function update(Request $request, $id)
    {
        try {
            $validator = Validator::make($request->all(), [
                'name' => 'required|min:3|max:255',
                'code' => 'required|unique:menus,id,'.$id,
                'status' => 'required',
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

            $updated = MenuModel::updateItem($id, $request->all());

            if(!$updated) {
                throw new \Exception("Не удалось обновить данные меню. Повторите попытку позже или обратитесь к администратору");
            }

        } catch (\Exception $exception) {
            return redirect()->back()->with('errorMessage', $exception->getMessage())->withInput();
        }

        return redirect()->route('dashboard.menu.edit', ['itemId' => $id])->with('successMessage', "Меню успешно обновлено!");
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Renderable
     */
    public function destroy($id)
    {
        $response = [
            'success' => false
        ];

        if(is_numeric($id) && !empty($id)) {
            $response['success'] = MenuModel::deleteItem($id);
        }

        return response()->json($response);
    }

    public function itemsIndex(int $id)
    {
        $this->pageData['items'] = MenuItemsModel::getList($id)->paginate(10);

        Breadcrumbs::setBreadcrumb(route('dashboard.menu.items.index', ['itemId' => $id]), 'Элементы меню сайта');
        $this->pageData['breadcrumbs'] = Breadcrumbs::getBreadcrumbs();
        $this->pageData['title'] = 'Элементы меню сайта';

        return view('menu::items.index', $this->pageData);
    }
}
