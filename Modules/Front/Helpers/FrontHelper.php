<?php

if(!function_exists('generateLangLink')) {
    function generateLangLink($url, $lang = null) {
        $defaultLocale = config()->get('app.defaultLocale');

        $url = preg_replace("#^\/([a-z]{2}+\/)#", "", $url);

        if($lang == $defaultLocale) {
            return preg_replace("#\/{$defaultLocale}#", "", $url);
        } else {

            $url = "/{$lang}{$url}";

            return $url;
        }
    }
}


if(!function_exists('switchLocaleLinks')) {
    function switchLocaleLinks($url, $lang) {
        $defaultLocale = config()->get('app.defaultLocale');
        $currentLocale = app()->getLocale();

        $url = preg_replace("#^\/{$lang}#", "", $url);
        $url = preg_replace("#^\/{$currentLocale}#", "", $url);
        $url = preg_replace("#^\/{$defaultLocale}#", "", $url);

        if(empty($url)) {
            $url = '/';
        }

        if($lang == $defaultLocale) {
            return $url;
        } else {
            return "/{$lang}{$url}";
        }
    }
}

if(!function_exists('isMainPage')) {
    function isMainPage() {
        $request = request();

        if(preg_match("#^\/$|(^\/[a-z]{2}+)$#", $request->getRequestUri())) {
            return true;
        } else {
            return false;
        }
    }
}
