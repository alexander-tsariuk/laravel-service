<?php

if(!function_exists('generateLangLink')) {
    function generateLangLink($url, $lang = null) {
        if(strtolower(app()->getLocale()) != $lang && $lang != config('app.defaultLocale')) {
            return "/{$lang}{$url}";
        } else{
            return preg_replace("#^\/".app()->getLocale()."#", "", $url);
        }
    }
}
