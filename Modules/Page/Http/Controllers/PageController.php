<?php

namespace Modules\Page\Http\Controllers;

use App\Http\Controllers\DashboardController;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Modules\Dashboard\Helpers\Breadcrumbs;
use Modules\Language\Entities\Language as LanguageModel;
use Modules\Page\Entities\Page as PageModel;
use Modules\Page\Entities\PageTranslation as PageTranslationModel;
use Illuminate\Support\Facades\Validator;

class PageController extends DashboardController
{
    public function __construct()
    {
        parent::__construct();

        Breadcrumbs::setBreadcrumb(route('dashboard.page.index'), 'Список страниц');
    }

    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {
        $this->pageData['items'] = PageModel::getList()->paginate(10);

        $this->pageData['breadcrumbs'] = Breadcrumbs::getBreadcrumbs();
        $this->pageData['title'] = 'Список страниц';

        return view('page::index', $this->pageData);
    }

    public function create()
    {
        $this->pageData['languages'] = LanguageModel::getList()->get();

        Breadcrumbs::setBreadcrumb(route('dashboard.page.create'), 'Новая страница');

        $this->pageData['breadcrumbs'] = Breadcrumbs::getBreadcrumbs();
        $this->pageData['title'] = 'Новая страница';

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
            return redirect()->back()->with('errorMessage', $exception->getMessage())->withInput();
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

        Breadcrumbs::setBreadcrumb(route('dashboard.page.edit', ['itemId' => $id]), 'Редактирование страницы');

        $this->pageData['breadcrumbs'] = Breadcrumbs::getBreadcrumbs();
        $this->pageData['title'] = 'Редактирование страницы';

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
            return redirect()->back()->with('errorMessage', $exception->getMessage())->withInput();
        }

        return response()->redirectToRoute('dashboard.page.edit', ['itemId' => $id])
            ->with('successMessage', "Страница была успешно обновлена!");
    }

    public function destroy($id)
    {
        $response = [
            'success' => true,
            'message' => null
        ];

        try {
            if(!is_numeric($id) || empty($id)) {
                throw new \Exception("При удалении элемента произошла ошибка. Повторите попытку или обратитесь к администратору!");
            }

            $item = PageModel::find($id);

            if(!$item) {
                throw new \Exception("При удалении элемента произошла ошибка. Повторите попытку или обратитесь к администратору!");
            }

            if(!$item->delete()) {
                throw new \Exception("При удалении элемента произошла ошибка. Повторите попытку или обратитесь к администратору!");
            } else {
                $response['message'] = "Выбранный элемент успешно удалён!";
            }
        } catch (\Exception $exception) {
            $response['message'] = $exception->getMessage();
            $response['success'] = false;
        }

        return response()->json($response);
    }

    public function uploadImage(Request $request, string $directory) {
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

            $uploadedFile = PageModel::uploadImage($directory, $request->all());

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
}
