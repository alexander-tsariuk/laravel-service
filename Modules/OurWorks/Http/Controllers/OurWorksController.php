<?php

namespace Modules\OurWorks\Http\Controllers;

use App\Http\Controllers\DashboardController;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Modules\Dashboard\Helpers\Breadcrumbs;
use Modules\Language\Entities\Language as LanguageModel;
use Modules\OurWorks\Entities\OurWork as OurWorkModel;
use Modules\OurWorks\Entities\OurWorkTranslation as OurWorkTranslationModel;

class OurWorksController extends DashboardController
{
    public function __construct()
    {
        parent::__construct();

        Breadcrumbs::setBreadcrumb(route('dashboard.ourservice.index'), 'Наши работы');
    }
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {
        $this->pageData['items'] = OurWorkModel::getList()->paginate(10);

        $this->pageData['breadcrumbs'] = Breadcrumbs::getBreadcrumbs();
        $this->pageData['title'] = 'Наши работы';

        return view('ourworks::index', $this->pageData);
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        $this->pageData['languages'] = LanguageModel::getList()->get();

        Breadcrumbs::setBreadcrumb(route('dashboard.ourservice.create'), 'Новый элемент');

        $this->pageData['breadcrumbs'] = Breadcrumbs::getBreadcrumbs();
        $this->pageData['title'] = 'Новый элемент';

        $this->pageData['services'] = OurWorkModel::getListWithExclude();

        return view('ourworks::create', $this->pageData);
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
                'prefix' => 'required|unique:our_works',
                'status' => 'required',
                'translation.*.name' => 'required|min:3|max:255',
            ], [
                'required' => "Поле :attribute обязательно к заполнению!",
                'unique' => "Значение поля :attribute должно быть уникальным!",
                'min' => 'Минимальная длина поля :attribute :min символов!',
                'max' => 'Максимальная длина поля :attribute :max символов!',
            ], [
                'prefix' => 'Алиас',
                'status' => 'Статус',
                'translation.*.name' => 'Название работы',
            ]);

            if($validator->fails()) {
                return redirect()->back()->withErrors($validator->errors())->withInput();
            }

            $item = OurWorkModel::createItem($request->all());

            if(!$item) {
                throw new \Exception("Неудалось создать элемент раздела \"Наши работы\". Повторите попытку позже или обратитесь к администратору!");
            }

            if(!OurWorkTranslationModel::createTranslations($item->id, $request->get('translation'))) {
                throw new \Exception("При создании переводов элемента \"Наши работы\" произошла ошибка. Повторите попытку позже или обратитесь к администратору!");
            }

        } catch (\Exception $exception) {
            return redirect()->back()->with('errorMessage', $exception->getMessage())->withInput();
        }

        return response()->redirectToRoute('dashboard.ourservice.edit', ['itemId' => $item->id])
            ->with('successMessage', 'Элемент раздела "Наши работы" успешно создан!');
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

        $this->pageData['item'] = OurWorkModel::find($id);

        if(!$this->pageData['item']) {
            abort(404);
        }

        $this->pageData['item']->preparedTranslations = $this->pageData['item']->prepareTranslationsByID();

        $this->pageData['languages'] = LanguageModel::getList()->get();

        Breadcrumbs::setBreadcrumb(route('dashboard.ourservice.edit', ['itemId' => $id]), 'Редактирование элемента');

        $this->pageData['breadcrumbs'] = Breadcrumbs::getBreadcrumbs();
        $this->pageData['title'] = 'Редактирование элемента';
        $this->pageData['services'] = OurWorkModel::getListWithExclude($id);

        return view('ourworks::edit', $this->pageData);
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
                'prefix' => 'required|unique:our_works,id,'.$id,
                'status' => 'required',
                'translation.*.name' => 'required'
            ], [
                'required' => "Поле :attribute обязательно к заполнению!",
                'unique' => "Значение поля :attribute должно быть уникальным!",
            ]);

            if($validator->fails()) {
                return response()->redirectToRoute('dashboard.ourservice.edit', ['itemId' => $id])
                    ->with('errorMessage', "При обновлении данных элемента произошла ошибка. Повторите попытку позже или обратитесь к администратору!");
            }

            $item = OurWorkModel::updateItem($id, $request->all());

            if(!$item) {
                throw new \Exception("Не удалось обновить элемент раздела \"Наши работы\". Повторите попытку позже или обратитесь к администратору!");
            }

            if(!OurWorkTranslationModel::updateTranslations($id, $request->get('translation'))) {
                throw new \Exception("При обновлении переводов элемента раздела \"Наши работы\" произошла ошибка. Повторите попытку позже или обратитесь к администратору!");
            }

        } catch (\Exception $exception) {
            return response()->redirectToRoute('dashboard.ourservice.edit', ['itemId' => $id])
                ->with('errorMessage', $exception->getMessage());
        }

        return response()->redirectToRoute('dashboard.ourservice.index')
            ->with('successMessage', 'Элемент раздела "Наши работы" успешно обновлён!');
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

    /**
     * Загрузка изображений слайда
     * @param Request $request
     * @param int $id
     * @return array
     */
    public function uploadImage(Request $request, int $id) {
        $response = [
            'success' => false,
            'messages' => null
        ];

        try {
            $validator = Validator::make($request->all(), [
                'uploadingFile' => 'required|mimes:jpeg,png,jpg,gif,svg|max:4096'
            ]);

            if($validator->fails()) {
                return $response['messages'][] = $validator->errors()->getMessages();
            }

            $uploadedFile = OurWorkModel::uploadImage($id, $request->all());

            if(!empty($uploadedFile)) {
                $response['success'] = true;
                $response['file'] = $uploadedFile;
                $response['messages'] = 'Изображение успешно загружено!';
            }

        } catch (\Exception $exception) {
            $response['messages'][] = $exception->getMessage();
        }

        return $response;
    }

    /**
     * Удаление изображений слайда
     * @param Request $request
     * @param int $id
     * @return array
     */
    public function deleteImage(Request $request, int $id) {
        $response = [
            'success' => false,
            'messages' => null
        ];

        try {
            $validator = Validator::make([
                'id' => $id
            ], [
                'id' => 'required|integer'
            ]);

            if($validator->fails()) {
                return $response['messages'][] = $validator->errors()->getMessages();
            }

            $uploadedFile = OurWorkModel::deleteImage($id, 'ourwork');

            if(!empty($uploadedFile)) {
                $response['success'] = true;
                $response['messages'] = 'Изображение успешно удалено!';
            }

        } catch (\Exception $exception) {
            $response['messages'][] = $exception->getMessage();
        }

        return $response;
    }
}
