<?php

namespace Modules\Front\Http\Controllers;

use Illuminate\Routing\Controller;
use Modules\Dashboard\Entities\Setting as SettingModel;
use Modules\OurWorks\Entities\OurWork as OurWorkModel;
use Modules\Page\Entities\Page;
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

        $this->pageData['menu'] = [
            'services' => OurWorkModel::getList()->where('status', 1)
                ->where('parentId', null)
                ->orWhere('parentId', 0)
                ->get(),
            'projects' => ProjectModel::getList()->where('status', 1)->get(),
        ];

    }

    public function index()
    {
        $this->pageData['langCode'] = app()->getLocale();
        $this->pageData['langId'] = config()->get('app.localeId');

        $this->pageData['services'] = OurWorkModel::getActiveList()
            ->where('parentId', null)
            ->limit(9)
            ->get();

        $this->pageData['ourWorks'] = ProjectModel::getActiveList()->limit(3)->get();

        $this->pageData['seo'] = $this->getSeoDataForMainPage($this->pageData['settings']);

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

    private function getSeoData($page) : object {
        $result = new \stdClass();
        $lang = $this->pageData['langCode'];

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

        if(isset($page->translation->set_noindex) && $page->translation->set_noindex != 0) {
            $result->robots .= 'noindex';
        } else {
            $result->robots .= 'index';
        }

        if(isset($page->translation->set_nofollow) && $page->translation->set_nofollow != 0) {
            $result->robots .= ',nofollow';
        } else {
            $result->robots .= ',follow';
        }

        return $result;
    }

    public function renderPage(string $firstPrefix, string $secondPage = '') {
        $this->pageData['langCode'] = app()->getLocale();
        $this->pageData['langId'] = config()->get('app.localeId');

        if(OurWorkModel::existsItem($firstPrefix, $secondPage)) {
            return $this->renderServicePage($firstPrefix, $secondPage);
        } elseif(ProjectModel::existsItem($firstPrefix)) {
            return $this->renderProjectPage($firstPrefix);
        } elseif(PageModel::existsItem($firstPrefix)) {
            return $this->renderContentPage($firstPrefix);
        }

        abort(404);
    }

    private function renderServicePage(string $firstPrefix, string $secondPrefix = '') {
        if(!$firstPrefix || (!$firstPrefix && !$secondPrefix)) {
            abort(404);
        }

        if(!empty($secondPrefix)) {
            $this->pageData['parentService'] = OurWorkModel::getByPrefix($firstPrefix);
            $this->pageData['service'] = OurWorkModel::getByPrefix($secondPrefix);
            $this->pageData['projects'] = ProjectModel::getList()
                ->where('serviceId', $this->pageData['service']->id)
                ->where('status', 1)
                ->get();
        } else {
            $this->pageData['service'] = OurWorkModel::getByPrefix($firstPrefix);
            $this->pageData['subServices'] = OurWorkModel::getChildList($this->pageData['service']->id);
            $this->pageData['projects'] = ProjectModel::getList()
                ->where('serviceId', $this->pageData['service']->id)
                ->where('status', 1)
                ->get();
        }

        if(!count($this->pageData['projects'])) {
            unset($this->pageData['projects']);
        }

        if(isset($this->pageData['subServices']) && !count($this->pageData['subServices'])) {
            unset($this->pageData['subServices']);
        }

        $this->pageData['seo'] = $this->getSeoData($this->pageData['service']);

        return view('front::service-page', $this->pageData);
    }

    private function renderProjectPage(string $projectPrefix) {
        if(!$projectPrefix) {
            abort(404);
        }

        $this->pageData['project'] = ProjectModel::getByPrefix($projectPrefix);

        if(!$this->pageData['project'] || (isset($this->pageData['project']) && $this->pageData['project']->translation->set_404 == 1)) {
            abort(404);
        }

        $this->pageData['seo'] = $this->getSeoData($this->pageData['project']);

        return view('front::project-page', $this->pageData);
    }

    private function renderContentPage(string $pagePrefix) {
        if(!$pagePrefix) {
            abort(404);
        }

        $this->pageData['page'] = PageModel::getByPrefix($pagePrefix);

        if(!$this->pageData['page'] || (isset($this->pageData['page']) && $this->pageData['page']->translation->set_404 == 1)) {
            abort(404);
        }

        $this->pageData['displayMap'] = true;
        if($pagePrefix != 'contact') {
            $this->pageData['displayMap'] = false;
        }

        $this->pageData['seo'] = $this->getSeoData($this->pageData['page']);

        return view('front::content-page', $this->pageData);
    }

}
