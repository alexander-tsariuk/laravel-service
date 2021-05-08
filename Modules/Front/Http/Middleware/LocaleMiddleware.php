<?php

namespace Modules\Front\Http\Middleware;

use Closure;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Modules\Front\Http\Controllers\FrontController;
use Modules\Language\Entities\Language as LanguageModel;

class LocaleMiddleware
{
    public static $mainLang;

    public static $languages;

    private $app;


    public function __construct(Application $application)
    {
        $this->app = $application;
    }

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

        config()->set('app.defaultLocale', $mainLang->prefix);
        config()->set('app.defaultLocaleId', $mainLang->id);

        config()->set('app.langId', $mainLang->id);
        config()->set('app.locale', $mainLang->prefix);



        $uri = \request()->getRequestUri(); //получаем URI

        $segmentsURI = explode('/', $uri); //делим на части по разделителю "/"

        $segmentsURI = array_filter($segmentsURI);

        //Проверяем метку языка  - есть ли она среди доступных языков
        if (!empty(current($segmentsURI)) && LanguageModel::existsByPrefix(current($segmentsURI))) {
            if (current($segmentsURI) != self::$mainLang) {
                $lang = LanguageModel::getLanguageByPrefix(current($segmentsURI));

                config()->set('app.locale', $lang->prefix);
                config()->set('app.localeId', $lang->id);

                \app()->setLocale($lang->prefix);

                return current($segmentsURI);
            } else {
                config()->set('app.locale', $mainLang->prefix);
                config()->set('app.localeId', $mainLang->id);
                \app()->setLocale($mainLang->prefix);
                return $mainLang->prefix;
            }
        } else {
            config()->set('app.locale', $mainLang->prefix);
            config()->set('app.localeId', $mainLang->id);
            \app()->setLocale($mainLang->prefix);
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

        if(isset($routeParameters['lang']) && !empty($routeParameters['lang']) && strlen($routeParameters['lang']) > 2) {
            $prefix = $request->route()->parameter('lang');
            $secondPrefix = $request->route()->parameter('prefix');

            $request->route()->forgetParameter('lang');
            $request->route()->forgetParameter('prefix');

            $request->route()->setParameter('prefix', $prefix);
            $request->route()->setParameter('subPrefix', $secondPrefix);
            $request->route()->setParameter('lang', "");

            $request->route()->setAction(array_merge($request->route()->getAction(), [
                'uses' => 'Modules\Front\Http\Controllers\FrontController@renderPage',
                'controller' => 'Modules\Front\Http\Controllers\FrontController@renderPage',
            ]));
        }

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

        if($request->route()->hasParameter('lang')) {
            $request->route()->forgetParameter('lang');
        }

        if($locale) {
            $this->app->setLocale($locale);
//            App::setLocale($locale);
//            config()->set('app.locale', $locale);
        }
        //если метки нет - устанавливаем основной язык $mainLanguage
        else {
            $this->app->setLocale(self::$mainLang);
//            App::setLocale(self::$mainLang);
//            config()->set('app.locale', self::$mainLang);
        }

        return $next($request); //пропускаем дальше - передаем в следующий посредник
    }
}
