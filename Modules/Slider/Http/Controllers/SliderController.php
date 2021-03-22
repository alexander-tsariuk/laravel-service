<?php

namespace Modules\Slider\Http\Controllers;

use App\Http\Controllers\DashboardController;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Modules\Language\Entities\Language as LanguageModel;
use Modules\Slider\Entities\Slider as SliderModel;
use Modules\Slider\Entities\SlideTranslation as SlideTranslationModel;
use PHPUnit\Util\Exception;

class SliderController extends DashboardController
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {
        $this->pageData['items'] = SliderModel::getList();

        return view('slider::index', $this->pageData);
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        $this->pageData['languages'] = LanguageModel::getList()->get();

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
            return redirect()->back()->withErrors($exception->getMessage(), 'general')->withInput();
        }

        return response()->redirectTo('dashboard.slider.edit', ['itemId' => $item->id])
            ->with('successMessage', "Слайд был успешно добавлен!");
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function show($id)
    {
        return view('slider::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit($id)
    {
        return view('slider::edit');
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Renderable
     */
    public function update(Request $request, $id)
    {
        //
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
