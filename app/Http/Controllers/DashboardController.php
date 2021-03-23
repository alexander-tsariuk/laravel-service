<?php

namespace App\Http\Controllers;

use Modules\Dashboard\Helpers\Breadcrumbs;

class DashboardController extends Controller {

    public $pageData = [];

    public function __construct()
    {
        Breadcrumbs::setBreadcrumb('/admin', 'Админ-панель');
    }

}
