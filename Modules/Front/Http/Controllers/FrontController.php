<?php

namespace Modules\Front\Http\Controllers;

use Illuminate\Routing\Controller;
use Modules\Dashboard\Entities\Setting as SettingModel;
use Modules\OurWorks\Entities\OurWork as OurWorkModel;
use Modules\Slider\Entities\Slider as SliderModel;

class FrontController extends Controller
{
    public $pageData;

    public function index()
    {
        $this->pageData['slides'] = SliderModel::getActiveList();
        $this->pageData['ourWorks'] = OurWorkModel::getActiveList();

        $this->pageData['settings'] = SettingModel::getList();

        return view('front::index', $this->pageData);
    }

}
