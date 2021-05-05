<?php

namespace Modules\Dashboard\Http\Controllers;

use Illuminate\Http\Request;
use Modules\Dashboard\Entities\Setting as SettingModel;
use Modules\Dashboard\Helpers\Breadcrumbs;

class SettingsController extends \App\Http\Controllers\DashboardController {

    public function __construct()
    {
        parent::__construct();

        Breadcrumbs::setBreadcrumb(route('dashboard.settings.index'), 'Основные настройки');
    }


    public function index() {
        $this->pageData['breadcrumbs'] = Breadcrumbs::getBreadcrumbs();

        $this->pageData['title'] = 'Основные настройки';

        $this->pageData['items'] = SettingModel::getList();

        return view('dashboard::settings.index', $this->pageData);
    }

    public function update(Request $request) {
        try {
            if(!empty($request->get('data'))) {
                SettingModel::updateItems($request->get('data'));
            }
        } catch (\Exception $exception) {
            return back()->with('errorMessage', $exception->getMessage());
        }

        return response()->redirectToRoute('dashboard.settings.index')->with('successMessage', 'Настройки успешно сохранены!');
    }

}
