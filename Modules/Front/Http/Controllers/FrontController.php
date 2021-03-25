<?php

namespace Modules\Front\Http\Controllers;

use Illuminate\Routing\Controller;
use Modules\Dashboard\Entities\Setting as SettingModel;
use Modules\OurWorks\Entities\OurWork as OurWorkModel;
use Modules\Slider\Entities\Slider as SliderModel;

class FrontController extends Controller
{
    public $pageData;

    public function index()
    {
        $this->pageData['slides'] = SliderModel::getActiveList();
        $this->pageData['ourWorks'] = OurWorkModel::getActiveList();

        $this->pageData['settings'] = SettingModel::getList();

        $this->pageData['seo'] = $this->getSeoData($this->pageData['settings']);
        $this->pageData['sitename'] = isset($this->pageData['settings']['general']['sitename']) && !empty($this->pageData['settings']['general']['sitename']) ? trim($this->pageData['settings']['general']['sitename']->content) : '';
        $this->pageData['siteurl'] = isset($this->pageData['settings']['general']['url']) && !empty($this->pageData['settings']['general']['url']) ? trim($this->pageData['settings']['general']['url']->content) : '';

        return view('front::index', $this->pageData);
    }

    private function getSeoData(array $settings) : object {
        $result = new \stdClass();
        $lang = 'ru';

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
