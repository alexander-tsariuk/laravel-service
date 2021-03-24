<?php

namespace Modules\Front\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Slider\Entities\Slider as SliderModel;

class FrontController extends Controller
{
    public $pageData;

    public function index()
    {
        $this->pageData['slides'] = SliderModel::getActiveList();

        return view('front::index', $this->pageData);
    }

}
