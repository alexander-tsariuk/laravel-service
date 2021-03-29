<?php

namespace Modules\Front\Http\Controllers;

use Illuminate\Routing\Controller;
use Modules\Dashboard\Entities\Setting as SettingModel;
use Modules\OurWorks\Entities\OurWork as OurWorkModel;
use Modules\Page\Entities\Page as PageModel;
use Modules\Project\Entities\Project as ProjectModel;
use Modules\Slider\Entities\Slider as SliderModel;

class FrontController extends Controller
{
    public $pageData;

    public function __construct() {
        $this->pageData['settings'] = SettingModel::getList();

        $this->pageData['sitename'] = isset($this->pageData['settings']['general']['sitename']) && !empty($this->pageData['settings']['general']['sitename']) ? trim($this->pageData['settings']['general']['sitename']->content) : '';
        $this->pageData['siteurl'] = isset($this->pageData['settings']['general']['url']) && !empty($this->pageData['settings']['general']['url']) ? trim($this->pageData['settings']['general']['url']->content) : '';
        $this->pageData['slides'] = SliderModel::getActiveList();
    }

    public function index()
    {
        $this->pageData['ourWorks'] = OurWorkModel::getActiveList();

        $this->pageData['seo'] = $this->getSeoDataForMainPage($this->pageData['settings']);

        return view('front::index', $this->pageData);
    }

    private function getSeoDataForMainPage(array $settings) : object {
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

    private function getSeoData($page) : object {
        $result = new \stdClass();
        $lang = 'ru';

        if(isset($page->translation->meta_title) && !empty($page->translation->meta_title)) {
            $result->title = trim($page->translation->meta_title);
        } else {
            $result->title = $page->translation->name;
        }

        if(isset($page->translation->meta_h1) && !empty($page->translation->meta_h1)) {
            $result->h1 = trim($page->translation->meta_h1);
        }

        if(isset($page->translation->meta_keywords) && !empty($page->translation->meta_keywords)) {
            $result->keywords = trim($page->translation->meta_keywords);
        }

        if(isset($page->translation->meta_description) && !empty($page->translation->meta_description)) {
            $result->description = trim($page->translation->meta_description);
        }

        $result->robots = '';

        if(isset($page->translation->set_noindex) && !empty($page->translation->set_noindex)) {
            $result->robots .= 'noindex';
        } else {
            $result->robots .= 'index';
        }

        if(isset($page->translation->set_nofollow) && !empty($page->translation->set_nofollow)) {
            $result->robots .= ',nofollow';
        } else {
            $result->robots .= ',follow';
        }

        return $result;
    }

    public function servicePage(string $servicePrefix) {
        if(!$servicePrefix) {
            abort(404);
        }

        $this->pageData['service'] = OurWorkModel::getByPrefix($servicePrefix);

        if(!$this->pageData['service']) {
            abort(404);
        }

        $this->pageData['seo'] = $this->getSeoData($this->pageData['service']);

        $this->pageData['projects'] = ProjectModel::getList()->where('status', 1)->get();

        return view('front::service-page', $this->pageData);
    }

    public function projectPage(string $projectPrefix) {
        if(!$projectPrefix) {
            abort(404);
        }

        $this->pageData['project'] = ProjectModel::getByPrefix($projectPrefix);

        if(!$this->pageData['project']) {
            abort(404);
        }

        $this->pageData['seo'] = $this->getSeoData($this->pageData['project']);

        return view('front::project-page', $this->pageData);
    }

    public function contentPage(string $pagePrefix) {
        if(!$pagePrefix) {
            abort(404);
        }

        $this->pageData['page'] = PageModel::getByPrefix($pagePrefix);

        if(!$this->pageData['page']) {
            abort(404);
        }

        $this->pageData['seo'] = $this->getSeoData($this->pageData['page']);

        return view('front::content-page', $this->pageData);
    }

}
