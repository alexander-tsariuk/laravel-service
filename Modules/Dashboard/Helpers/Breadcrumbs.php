<?php

namespace Modules\Dashboard\Helpers;

class Breadcrumbs {
    private static $breadcrumbs = [];

    public static function setBreadcrumb(string $route, string $name) {
        self::$breadcrumbs[] = [
            'route' => $route,
            'name' => $name
        ];
    }

    public static function getBreadcrumbs() {
        return self::$breadcrumbs;
    }
}
