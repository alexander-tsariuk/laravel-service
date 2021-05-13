<?php

namespace Modules\Front\Http\Controllers;

use App\Http\Controllers\Controller;
use Carbon\Carbon;
//use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\View;
use Jenssegers\Agent\Agent;
use Modules\ContactUs\Entities\ContactUs as ContactUsModel;
use Modules\Dashboard\Entities\Setting as SettingModel;
use Modules\Language\Entities\Language;
use Modules\Menu\Entities\Menu;
use Modules\OurWorks\Entities\OurWork as OurWorkModel;
use Modules\Page\Entities\Page;
use Modules\Page\Entities\Page as PageModel;
use Modules\Project\Entities\Project as ProjectModel;
use Modules\Slider\Entities\Slider as SliderModel;
use Illuminate\Http\Request;

class FrontController extends Controller
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

        $this->pageData['agent'] = new Agent();
    }

    public function index()
    {
        $this->getMainData();
        $lang = app()->getLocale();

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
        $this->getMainData();

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
                ->paginate($this->projectsPerPage);
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

       if($pagePrefix == 'contact') {
            $this->pageData['displayMap'] = true;
        }

        $this->pageData['seo'] = $this->getSeoData($this->pageData['page']);

        return view('front::content-page', $this->pageData);
    }


    public function ajaxProjectsLoad() {
        $result = [
            'success' => true,
            'message' => null,
            'items' => null,
            'hideButton' => false,
            'nextPage' => 0
        ];

        try {
            $validation = Validator::make(request()->all(), [
                'currentPage' => 'required|integer',
                'service' => 'required|integer',
                'lang' => 'required|max:2'
            ], [
                'required' => "Поле \":attribute\" обязательно к заполнению",
                'integer' => "Поле \":attribute\" должно иметь числовое значение",
                'max' => "Максимальная длина поля \":attribute\" должна иметь не более :max символом",
            ]);

            if($validation->fails()) {
                throw new \Exception("При загрузке списка проектов произошла ошибка!");
            }

            $loadingPage = (int)request()->get('currentPage');

            $result['nextPage'] = $loadingPage + 1;

            $projects = ProjectModel::getList()
                ->where('serviceId', request()->get('service'))
                ->where('status', 1)
                ->offset($this->projectsPerPage * $loadingPage)
                ->take($this->projectsPerPage)
                ->get();

            $html = "";

            $count = ProjectModel::getList()
                ->where('serviceId', request()->get('service'))
                ->where('status', 1)
                ->count();

            if($this->projectsPerPage * $loadingPage + 1 >= $count ) {
                $result['hideButton'] = true;
            }

            app()->setLocale(request()->get('lang'));

            foreach ($projects as $project) {
                $html .= view("front::ajax.projects.row", ['project' => $project])->render();
            }

            $result['items'] = $html;

        } catch (\Exception $exception) {
            $result['success'] = false;
            $result['message'] = $exception->getMessage();
        }

        return response()->json($result);
    }

    public function ajaxSendMessage(Request $request) {
        $response = [
            'success' => true,
            'message' => ''
        ];

        try {
            $validate = Validator::make($request->all(), [
                'name' => 'required|min:2|max:255',
                'phone' => 'required',
                'lang' => 'required'
            ], [
                'required' => __('front::mainpage.contact.required', [], $request->get('lang')),
                'min' => __('front::mainpage.contact.min', [], $request->get('lang')),
                'max' => __('front::mainpage.contact.max', [], $request->get('lang')),
            ], [
                'name' => 'Ваше имя',
                'phone' => 'Номер телефона',
            ]);

            if($validate->fails()) {
                throw new \Exception($validate->errors()->first());
            }

            $to_name = "администратор сайта";
            $to_email = env('MAIL_FROM_ADDRESS');

            $data = array(
                'subject'=> "Поступила новая заявка с сайта ".env("APP_NAME"),
                'request' => $request->all(),
            );

            Mail::send('front::emails.contact_us', $data, function($message) use ($to_name, $to_email, $data) {
                $message->to($to_email, $to_name)->subject($data['subject']);
                $message->from(env('MAIL_FROM_ADDRESS'), env('MAIL_FROM_NAME'));
            });

            ContactUsModel::createItem([
                'name' => $request->get('name'),
                'phone' => $request->get('phone'),
                'comment' => $request->get('message', null)
            ]);

            $response['message'] = __('front::mainpage.contact.success', [], $request->get('lang'));

        } catch(\Exception $exception) {
            $response['success'] = false;
            $response['message'] = $exception->getMessage();
        }

        return response()->json($response);
    }

}
