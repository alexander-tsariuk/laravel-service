<?php

namespace Modules\OurWorks\Http\Controllers;

use App\Http\Controllers\DashboardController;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Modules\OurWorks\Entities\OurWork as OurWorkModel;

class OurWorksController extends DashboardController
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {
        $this->pageData['items'] = OurWorkModel::getList();

        return view('ourworks::index', $this->pageData);
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
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
                'status' => 'required'
            ], [
                'required' => "Поле :attribute обязательно к заполнению!",
                'unique' => "Значение поля :attribute должно быть уникальным!",
            ]);

            if($validator->fails()) {
                return redirect()->back()->withErrors($validator->errors())->withInput();
            }

            $item = OurWorkModel::createItem($request->all());

            if(!$item) {
                throw new \Exception("Неудалось создать элемент раздела \"Наши работы\". Повторите попытку позже или обратитесь к администратору!");
            }

        } catch (\Exception $exception) {
            return redirect()->back()->withErrors($exception->getMessage(), 'global')->withInput();
        }

        return response()->redirectToRoute('dashboard.ourwork.edit', ['itemId' => $item->id])
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
                'prefix' => 'required|unique:our_works',
                'status' => 'required',
                'translation.*.name'
            ], [
                'required' => "Поле :attribute обязательно к заполнению!",
                'unique' => "Значение поля :attribute должно быть уникальным!",
            ]);

            if($validator->fails()) {
                return redirect()->back()->withErrors($validator->errors())->withInput();
            }

            $item = OurWorkModel::updateItem($id, $request->all());

            if(!$item) {
                throw new \Exception("Неудалось создать элемент раздела \"Наши работы\". Повторите попытку позже или обратитесь к администратору!");
            }

        } catch (\Exception $exception) {
            return redirect()->back()->withErrors($exception->getMessage(), 'global')->withInput();
        }

        return response()->redirectToRoute('dashboard.ourwork.index')
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
}
