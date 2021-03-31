<?php

namespace Modules\Front\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Modules\Front\Http\Controllers\FrontController;
use Modules\Language\Entities\Language as LanguageModel;

class LocaleMiddleware
{
    public static $mainLang;

    public static $languages;

    /*
     * Проверяет наличие корректной метки языка в текущем URL
     * Возвращает метку или значеие null, если нет метки
     */
    public static function getLocale()
    {
        self::$languages = LanguageModel::getList()->where('status', 1)->get();
        $mainLang = LanguageModel::getMainLanguage();

        if(!empty($mainLang)) {
            self::$mainLang = $mainLang->prefix;
        } else {
            abort(404);
        }

        $uri = \request()->getRequestUri(); //получаем URI

        $segmentsURI = explode('/', $uri); //делим на части по разделителю "/"

        $segmentsURI = array_filter($segmentsURI);

        //Проверяем метку языка  - есть ли она среди доступных языков
        if (!empty(current($segmentsURI)) && LanguageModel::existsByPrefix(current($segmentsURI))) {
            if (current($segmentsURI) != self::$mainLang) {
                $lang = LanguageModel::getLanguageByPrefix(current($segmentsURI));

                session('langCode', $lang->prefix);
                session('langId', $lang->id);

                setcookie('langCode', $lang->prefix, time() + 60 * 60 * 60);
                setcookie('langId', $lang->id, time() + 60 * 60 * 60);

                return current($segmentsURI);
            } else {
                session('langCode', $mainLang->prefix);
                session('langId', $mainLang->id);

                setcookie('langCode', $mainLang->prefix, time() + 60 * 60 * 60);
                setcookie('langId', $mainLang->id, time() + 60 * 60 * 60);

                return $mainLang->prefix;
            }
        } else {
            session('langCode', $mainLang->prefix);
            session('langId', $mainLang->id);

            setcookie('langCode', $mainLang->prefix, time() + 60 * 60 * 60);
            setcookie('langId', $mainLang->id, time() + 60 * 60 * 60);

            return $mainLang->prefix;
        }
    }


    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        $locale = self::getLocale();

        $routeParameters = $request->route()->parameters();

        if(isset($routeParameters['prefix']) && isset($routeParameters['subPrefix']) && $_COOKIE['langCode'] == $routeParameters['prefix']) {
            $request->route()->setParameter('prefix', $request->route()->parameter('subPrefix'));
            $request->route()->setParameter('subPrefix', "");
        } elseif(isset($routeParameters['prefix']) && !isset($routeParameters['subPrefix']) && $_COOKIE['langCode'] == $routeParameters['prefix']) {
            $request->route()->forgetParameter('prefix');
            $request->route()->setAction(array_merge($request->route()->getAction(), [
                'uses' => 'Modules\Front\Http\Controllers\FrontController@index',
                'controller' => 'Modules\Front\Http\Controllers\FrontController@index',
            ]));
        }

        if($locale) {
            App::setLocale($locale);
        }
        //если метки нет - устанавливаем основной язык $mainLanguage
        else {
            App::setLocale(self::$mainLang);
        }


        return $next($request); //пропускаем дальше - передаем в следующий посредник
    }
}
