<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Modules\Dashboard\Helpers\Breadcrumbs;

class DashboardController extends Controller {
    public $pageData = [];

    public function __construct()
    {
        Carbon::setLocale('ru');
        $this->middleware('auth');

        Breadcrumbs::setBreadcrumb('/admin', 'Админ-панель');
    }
}
