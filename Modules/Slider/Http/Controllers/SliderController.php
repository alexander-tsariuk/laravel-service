<?php

namespace Modules\Slider\Http\Controllers;

use App\Http\Controllers\DashboardController;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Modules\Dashboard\Helpers\Breadcrumbs;
use Modules\Language\Entities\Language as LanguageModel;
use Modules\Slider\Entities\Slider as SliderModel;
use Modules\Slider\Entities\SlideTranslation as SlideTranslationModel;

class SliderController extends DashboardController
{
    public function __construct()
    {
        parent::__construct();

        Breadcrumbs::setBreadcrumb(route('dashboard.slider.index'), 'Слайдер');
    }

    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {
        $this->pageData['items'] = SliderModel::getList();

        $this->pageData['breadcrumbs'] = Breadcrumbs::getBreadcrumbs();
        $this->pageData['title'] = 'Слайдер';

        return view('slider::index', $this->pageData);
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        $this->pageData['languages'] = LanguageModel::getList()->get();

        Breadcrumbs::setBreadcrumb(route('dashboard.slider.create'), 'Новый слайд');

        $this->pageData['breadcrumbs'] = Breadcrumbs::getBreadcrumbs();
        $this->pageData['title'] = 'Новый слайд';

        return view('slider::create', $this->pageData);
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
                'status' => 'required',
                'translation.*.heading_text' => 'required|min:3|max:255'
            ], [
                'required' => 'Поле :attribute обязательно к заполнению!',
                'min' => 'Минимальная длина поля :attribute :min символов!',
                'max' => 'Максимальная длина поля :attribute :max символов!',
                'unique' => 'Значение поля :attribute должно быть уникальным!',
            ], [
                'translation.*.heading_text' => 'Заглавный текст',
                'status' => 'Статус',
                'translation.*.description' => 'Описание',
            ]);

            if($validator->fails()) {
                return response()->redirectToRoute('dashboard.slider.create')->withErrors($validator->errors())->withInput();
            }

            $item = SliderModel::createItem($request->all());

            if(!$item) {
                throw new \Exception("При создании слайда произошла ошибка. Повторите попытку позже или обратитесь к администратору!");
            }

            if(!SlideTranslationModel::createTranslations($item->id, $request->get('translation'))) {
                throw new \Exception("При создании переводов слайда произошла ошибка. Повторите попытку позже или обратитесь к администратору!");
            }
        } catch (\Exception $exception) {
            return redirect()->back()->with('errorMessage', $exception->getMessage())->withInput();
        }

        return response()->redirectToRoute('dashboard.slider.edit', ['itemId' => $item->id])
            ->with('successMessage', "Слайд был успешно добавлен!");
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

        $this->pageData['item'] = SliderModel::find($id);

        if(!$this->pageData['item']) {
            abort(404);
        }

        $this->pageData['item']->preparedTranslations = $this->pageData['item']->prepareTranslationsByID();

        $this->pageData['languages'] = LanguageModel::getList()->get();

        Breadcrumbs::setBreadcrumb(route('dashboard.slider.edit', ['itemId' => $id]), 'Редактирование слайда');

        $this->pageData['breadcrumbs'] = Breadcrumbs::getBreadcrumbs();
        $this->pageData['title'] = 'Редактирование слайда';

        return view('slider::edit', $this->pageData);
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
                'status' => 'required',
                'translation.*.heading_text' => 'required|min:3|max:255'
            ], [
                'required' => 'Поле :attribute обязательно к заполнению!',
                'min' => 'Минимальная длина поля :attribute :min символов!',
                'max' => 'Максимальная длина поля :attribute :max символов!',
                'unique' => 'Значение поля :attribute должно быть уникальным!',
            ], [
                'translation.*.heading_text' => 'Заглавный текст',
                'status' => 'Статус',
                'translation.*.description' => 'Описание',
            ]);

            if($validator->fails()) {
                return response()->redirectToRoute('dashboard.slider.edit', ['itemId' => $id])->withErrors($validator->errors())->withInput();
            }

            $item = SliderModel::updateItem($id, $request->all());

            if(!$item) {
                throw new \Exception("При создании слайда произошла ошибка. Повторите попытку позже или обратитесь к администратору!");
            }

            if(!SlideTranslationModel::updateTranslations($id, $request->get('translation'))) {
                throw new \Exception("При обновлении переводов слайда произошла ошибка. Повторите попытку позже или обратитесь к администратору!");
            }
        } catch (\Exception $exception) {
            return redirect()->back()->with('errorMessage', $exception->getMessage())->withInput();
        }

        return response()->redirectToRoute('dashboard.slider.edit', ['itemId' => $id])
            ->with('successMessage', "Слайд был успешно обновлён!");
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Renderable
     */
    public function destroy($id)
    {
        dd($id);
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

            $uploadedFile = SliderModel::uploadImage($id, $request->all());

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

            $uploadedFile = SliderModel::deleteImage($id, 'slider');

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
