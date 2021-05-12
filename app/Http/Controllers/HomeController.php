<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Modules\Dashboard\Entities\Setting as SettingModel;
use Modules\Language\Entities\Language;
use Modules\Menu\Entities\Menu;
use Modules\OurWorks\Entities\OurWork as OurWorkModel;
use Modules\Project\Entities\Project as ProjectModel;
use Modules\Slider\Entities\Slider as SliderModel;
use Jenssegers\Agent\Agent;

class HomeController extends Controller
{
    public $pageData;

    private $projectsPerPage = 9;


    private function getMainData() {
        $lang = app()->getLocale();

        if(Cache::has('front.settings.'.$lang)) {
            $this->pageData['settings'] = Cache::get('front.settings.'.$lang);
        } else {
            $this->pageData['settings'] = Cache::rememberForever('front.settings.'.$lang, function () {
                return SettingModel::getList();
            });
        }

        $this->pageData['sitename'] = isset($this->pageData['settings']['general']['sitename']) && !empty($this->pageData['settings']['general']['sitename']) ? trim($this->pageData['settings']['general']['sitename']->content) : '';
        $this->pageData['siteurl'] = isset($this->pageData['settings']['general']['url']) && !empty($this->pageData['settings']['general']['url']) ? trim($this->pageData['settings']['general']['url']->content) : '';


        $this->pageData['displayMap'] = false;

        $this->pageData['menu'] = [
            'services' => OurWorkModel::getList()->where('status', 1)
                ->where('parentId', null)
                ->orWhere('parentId', 0)
                ->get(),
            'projects' => ProjectModel::getList()->where('status', 1)->where('showInMenu', 1)->get(),
            'top_menu' => Menu::where('code', 'top-menu')->first(),
            'bottom_menu' => Menu::where('code', 'bottom-menu')->first(),
        ];


        if(Cache::has('front.languages.'.$lang)) {
            $this->pageData['languages'] = Cache::get('front.languages.'.$lang);
        } else {
            $this->pageData['languages'] = Cache::rememberForever('front.languages.'.$lang, function () {
                return Language::getList()->where('status', 1)->get();
            });
        }
    }


    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $this->getMainData();
        $lang = app()->getLocale();

        $this->pageData['agent'] = new Agent();

        if(Cache::has('front.slides.'.$lang)) {
            $this->pageData['slides'] = Cache::get('front.slides.'.$lang);
        } else {
            $this->pageData['slides'] = Cache::rememberForever('front.slides.'.$lang, function () {
                return SliderModel::getActiveList();
            });
        }

        $this->pageData['langCode'] = app()->getLocale();
        $this->pageData['langId'] = config()->get('app.localeId');

        if(Cache::has('front.mainpage.services.'.$lang)) {
            $this->pageData['services'] = Cache::get('front.mainpage.services.'.$lang);
        } else {
            $this->pageData['services'] = Cache::rememberForever('front.mainpage.services.'.$lang, function () {
                return OurWorkModel::getActiveList()
                    ->where('parentId', null)
                    ->limit(9)
                    ->get();
            });
        }

        if(Cache::has('front.mainpage.ourWorks.'.$lang)) {
            $this->pageData['ourWorks'] = Cache::get('front.mainpage.ourWorks.'.$lang);
        } else {
            $this->pageData['ourWorks'] = Cache::rememberForever('front.mainpage.ourWorks.'.$lang, function () {
                return ProjectModel::getActiveList()->limit(3)->get();
            });
        }

        $this->pageData['displayMap'] = true;


        if(Cache::has('seo.mainpage.'.$lang)) {
            $this->pageData['seo'] = Cache::get('seo.mainpage.'.$lang);
        } else {
            $this->pageData['seo'] = Cache::rememberForever('seo.mainpage.'.$lang, function () {
                return $this->getSeoDataForMainPage($this->pageData['settings']);
            });
        }

        return view('front::index', $this->pageData);
    }

    private function getSeoDataForMainPage(array $settings) : object {
        $result = new \stdClass();
        $lang = $this->pageData['langCode'];

        if(isset($settings['mainpage_seo']) && !empty($settings['mainpage_seo'])) {
            if(isset($settings['mainpage_seo']['title_'.$lang]) && !empty($settings['mainpage_seo']['title_'.$lang]->content)) {
                $result->title = trim($settings['mainpage_seo']['title_'.$lang]->content);
            }
            if(isset($settings['mainpage_seo']['h1_'.$lang]) && !empty($settings['mainpage_seo']['h1_'.$lang]->content)) {
                $result->h1 = trim($settings['mainpage_seo']['h1_'.$lang]->content);
            }
            if(isset($settings['mainpage_seo']['keywords_'.$lang]) && !empty($settings['mainpage_seo']['keywords_'.$lang]->content)) {
                $result->keywords = trim($settings['mainpage_seo']['keywords_'.$lang]->content);
            }
            if(isset($settings['mainpage_seo']['description_'.$lang]) && !empty($settings['mainpage_seo']['description_'.$lang]->content)) {
                $result->description = trim($settings['mainpage_seo']['description_'.$lang]->content);
            }
        }

        return $result;
    }

}
