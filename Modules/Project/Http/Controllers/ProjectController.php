<?php

namespace Modules\Project\Http\Controllers;

use App\Http\Controllers\DashboardController;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Modules\Dashboard\Helpers\Breadcrumbs;

use Modules\Language\Entities\Language as LanguageModel;
use Modules\OurWorks\Entities\OurWork as OurWorkModel;
use Modules\Project\Entities\Project as ProjectModel;
use Modules\Project\Entities\ProjectImages as ProjectImagesModel;
use Modules\Project\Entities\ProjectTranslation as ProjectTranslationModel;

class ProjectController extends DashboardController
{
    public function __construct()
    {
        parent::__construct();

        Breadcrumbs::setBreadcrumb(route('dashboard.project.index'), 'Проекты');
    }
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {
        $this->pageData['items'] = ProjectModel::getList()->paginate(10);

        $this->pageData['breadcrumbs'] = Breadcrumbs::getBreadcrumbs();
        $this->pageData['title'] = 'Проекты';

        return view('project::index', $this->pageData);
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        $this->pageData['languages'] = LanguageModel::getList()->get();

        Breadcrumbs::setBreadcrumb(route('dashboard.project.create'), 'Новый элемент');

        $this->pageData['breadcrumbs'] = Breadcrumbs::getBreadcrumbs();
        $this->pageData['title'] = 'Новый элемент';

        $this->pageData['services'] = OurWorkModel::getList()->get();

        return view('project::create', $this->pageData);
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

            $item = ProjectModel::createItem($request->all());

            if(!$item) {
                throw new \Exception("Неудалось создать элемент раздела \"Проект\". Повторите попытку позже или обратитесь к администратору!");
            }

            if(!ProjectTranslationModel::createTranslations($item->id, $request->get('translation'))) {
                throw new \Exception("При создании переводов элемента \"Проект\" произошла ошибка. Повторите попытку позже или обратитесь к администратору!");
            }
            cache()->forget('front.mainpage.ourWorks');

        } catch (\Exception $exception) {
            return redirect()->back()->with('errorMessage', $exception->getMessage())->withInput();
        }

        return response()->redirectToRoute('dashboard.project.edit', ['itemId' => $item->id])
            ->with('successMessage', 'Элемент раздела "Проект" успешно создан!');
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

        $this->pageData['item'] = ProjectModel::find($id);

        if(!$this->pageData['item']) {
            abort(404);
        }

        $this->pageData['item']->preparedTranslations = $this->pageData['item']->prepareTranslationsByID();

        $this->pageData['languages'] = LanguageModel::getList()->get();

        Breadcrumbs::setBreadcrumb(route('dashboard.project.edit', ['itemId' => $id]), 'Редактирование элемента');

        $this->pageData['breadcrumbs'] = Breadcrumbs::getBreadcrumbs();
        $this->pageData['title'] = 'Редактирование элемента';

        $this->pageData['services'] = OurWorkModel::getList()->get();

        return view('project::edit', $this->pageData);
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
                'translation.*.name'
            ], [
                'required' => "Поле :attribute обязательно к заполнению!",
                'unique' => "Значение поля :attribute должно быть уникальным!",
            ]);

            if($validator->fails()) {
                return redirect()->back()->withErrors($validator->errors())->withInput();
            }

            $item = ProjectModel::updateItem($id, $request->all());

            if(!$item) {
                throw new \Exception("Не удалось обновить элемент раздела \"Проект\". Повторите попытку позже или обратитесь к администратору!");
            }

            if(!ProjectTranslationModel::updateTranslations($id, $request->get('translation'))) {
                throw new \Exception("При обновлении переводов элемента раздела \"Проект\" произошла ошибка. Повторите попытку позже или обратитесь к администратору!");
            }
            cache()->forget('front.mainpage.ourWorks');

        } catch (\Exception $exception) {
            return redirect()->back()->withErrors($exception->getMessage(), 'global')->withInput();
        }

        return response()->redirectToRoute('dashboard.project.index')
            ->with('successMessage', 'Элемент раздела "Проект" успешно обновлён!');
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Renderable
     */
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

            $item = ProjectModel::find($id);

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

        cache()->forget('front.mainpage.services');
        return response()->json($response);
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

            $uploadedFile = ProjectModel::uploadImage($id, $request->all(), [
                'width' => 635
            ]);

            if(!empty($uploadedFile)) {
                $response['success'] = true;
                $response['file'] = $uploadedFile;
                $response['messages'] = 'Изображение успешно загружено!';
            }
            cache()->forget('front.mainpage.ourWorks');

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

            $uploadedFile = ProjectModel::deleteImage($id, 'project');

            if(!empty($uploadedFile)) {
                $response['success'] = true;
                $response['messages'] = 'Изображение успешно удалено!';
            }
            cache()->forget('front.mainpage.ourWorks');

        } catch (\Exception $exception) {
            $response['messages'][] = $exception->getMessage();
        }

        return $response;
    }

    /**
     * Загрузка изображений галереи проекта
     * @param Request $request
     * @param int $id
     * @return array
     */
    public function uploadGalleryImage(Request $request, int $id) {
        $response = [
            'success' => false,
        ];

        try {
            $validator = Validator::make($request->all(), [
                'uploadingFile.*' => 'required|mimes:jpeg,png,jpg,gif,svg|max:4096'
            ]);

            if($validator->fails()) {
                return response()->json([
                    'error' => $validator->errors()->first()
                ]);
            }

            $uploadingFiles = $request->uploadingFile;

            foreach ($uploadingFiles as $uploadingFile) {
                $uploadedFile = ProjectImagesModel::uploadImages($id, $uploadingFile);
            }

            if(!empty($uploadedFile)) {
                $response['success'] = $uploadedFile;
            }
            cache()->forget('front.mainpage.ourWorks');

        } catch (\Exception $exception) {
            $response['error'] = $exception->getMessage();
        }

        return response()->json($response);
    }

    public function deleteGalleryImage(int $id) {
        $response = [
            'success' => true,
            'message' => null
        ];

        try {
            $projectImage = ProjectImagesModel::find($id);

            if(!$projectImage) {
                throw new \Exception("Не удалось удалить изображение. Повторите попытку или обратитесь к администратору!");
            }

            if(ProjectImagesModel::deleteImage($projectImage->id, 'project-images')) {
                $response['message'] = "Выбранное изображение успешно удалено!";
            } else{
                throw new \Exception("Не удалось удалить изображение. Повторите попытку или обратитесь к администратору!");
            }
            cache()->forget('front.mainpage.ourWorks');
        } catch (\Exception $exception) {
            $response['success'] = false;
            $response['message'] = $exception->getMessage();
        }

        return response()->json($response);
    }
}
