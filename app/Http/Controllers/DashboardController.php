<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Support\Facades\Cache;
use Modules\Dashboard\Helpers\Breadcrumbs;
use Modules\Language\Entities\Language;

class DashboardController extends Controller {
    public $pageData = [];

    public function __construct()
    {
        Carbon::setLocale('ru');
        $this->middleware('auth');

        Breadcrumbs::setBreadcrumb('/admin', 'Админ-панель');
    }


    public function clearCache($cacheKey) {
        $languages = Language::all();

        foreach ($languages as $language) {
            Cache::forget("{$cacheKey}.{$language->prefix}");
        }
    }
}
