<?php

namespace Modules\Dashboard\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Cache;
use Modules\Language\Entities\Language;

class DashboardController extends \App\Http\Controllers\DashboardController
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {
        $this->pageData['title'] = 'Главная';

        return view('dashboard::index', $this->pageData);
    }
}
