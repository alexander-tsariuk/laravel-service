<?php

namespace Modules\User\Http\Controllers;

use App\Http\Controllers\DashboardController;
use App\Models\User as UserModel;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Modules\Dashboard\Helpers\Breadcrumbs;

class UserController extends DashboardController
{
    public function __construct()
    {
        parent::__construct();

        Breadcrumbs::setBreadcrumb(route('dashboard.user.index'), 'Пользователи');
    }

    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {
        $this->pageData['items'] = UserModel::getList()->paginate(10);

        $this->pageData['breadcrumbs'] = Breadcrumbs::getBreadcrumbs();

        return view('user::index', $this->pageData);
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        Breadcrumbs::setBreadcrumb(route('dashboard.user.create'), 'Новый пользователь');

        $this->pageData['breadcrumbs'] = Breadcrumbs::getBreadcrumbs();

        return view('user::create', $this->pageData);
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
                'name' => 'required|min:2|max:255',
                'surname' => 'required|min:2|max:255',
                'email' => 'required|unique:users',
                'phone' => 'required|unique:users',
                'status' => 'required',
            ], [
                'required' => 'Поле :attribute обязательно к заполнению!',
                'min' => 'Минимальная длина поля :attribute :min символов!',
                'max' => 'Максимальная длина поля :attribute :max символов!',
                'unique' => 'Значение поля :attribute должно быть уникальным!',
            ], [
                'name' => 'Имя',
                'surname' => 'Фамилия',
                'status' => 'Статус',
                'phone' => 'Телефон',
                'email' => 'E-mail',
            ]);

            if($validator->fails()) {
                return redirect()->back()->withErrors($validator)->withInput();
            }

            $item = UserModel::createItem($request->all());

            if(!$item) {
                throw new \Exception("Не удалось создать пользователя. Повторите попытку позже или обратитесь к администратору.");
            }

        } catch (\Exception $exception) {
            return redirect()->back()->withErrors($exception->getMessage(), 'general')->withInput();
        }

        return redirect()->route('dashboard.user.edit', ['itemId' => $item->id])->with('successMessage', "Пользователь успешно создан!");
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

        $this->pageData['item'] = UserModel::find($id);

        if(!$this->pageData['item']) {
            abort(404);
        }

        Breadcrumbs::setBreadcrumb(route('dashboard.user.edit', ['itemId' => $id]), 'Редактирование пользователя');

        $this->pageData['breadcrumbs'] = Breadcrumbs::getBreadcrumbs();

        return view('user::edit', $this->pageData);
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Renderable
     */
    public function update(Request $request, int $id)
    {
        try {
            $validator = Validator::make($request->all(), [
                'name' => 'required|min:2|max:255',
                'surname' => 'required|min:2|max:255',
                'email' => 'required|unique:users,id,'.$id,
                'phone' => 'required|unique:users,id,'.$id,
                'status' => 'required',
            ], [
                'required' => 'Поле :attribute обязательно к заполнению!',
                'min' => 'Минимальная длина поля :attribute :min символов!',
                'max' => 'Максимальная длина поля :attribute :max символов!',
                'unique' => 'Значение поля :attribute должно быть уникальным!',
            ], [
                'name' => 'Имя',
                'surname' => 'Фамилия',
                'status' => 'Статус',
                'phone' => 'Телефон',
                'email' => 'E-mail',
            ]);

            if($validator->fails()) {
                return redirect()->back()->withErrors($validator)->withInput();
            }

            $updated = UserModel::updateItem($id, $request->all());

            if(!$updated) {
                throw new \Exception("Не удалось обновить данные пользователя. Повторите попытку позже или обратитесь к администратору");
            }

        } catch (\Exception $exception) {
            return redirect()->back()->withErrors($exception->getMessage(), 'general')->withInput();
        }

        return redirect()->route('dashboard.user.edit', ['itemId' => $id])->with('successMessage', "Данные пользователя успешно обновлены!");
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Renderable
     */
    public function destroy($id)
    {
        //
    }
}
