@if($agent->isMobile())
<!--offcanvas menu area start-->
<div class="body_overlay"></div>
<div class="offcanvas_menu">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="offcanvas_menu_wrapper">
                    <div class="canvas_close">
                        <a href="javascript:void(0)"><i class="ion-android-close"></i></a>
                    </div>
                    <div id="menu" class="text-left">
                        <ul class="offcanvas_main_menu">
                            <li class="menu-item-has-children active">
                                @if(request()->route()->getName() == 'front.home')
                                    <a class="active">{{ __('front::mainpage.home') }}</a>
                                @else
                                    <a href="{{ route('front.home', ['lang' => app()->getLocale() != config()->get('app.defaultLocale') ? app()->getLocale() : null]) }}">{{ __('front::mainpage.home') }}</a>
                                @endif
                            </li>


                            @if(isset($menu['top_menu']) && !empty($menu['top_menu']))
                                @if(isset($menu['top_menu']->items) && !empty($menu['top_menu']->items))
                                    @foreach($menu['top_menu']->items as $menuItem)
                                        <li class="menu-item-has-children">
                                            <a href="{{ generateLangLink($menuItem->url, app()->getLocale()) }}">{{ $menuItem->translation->label }}</a>
                                        </li>
                                    @endforeach
                                @endif
                            @endif

                            @if(isset($menu['services']) && !empty($menu['services']))
                                <li class="menu-item-has-children">
                                    <a class="" href="javascript:void(0);">{{ __('front::label.services') }}</a>
                                    <ul class="sub-menu">
                                        @foreach($menu['services'] as $serviceMenu)
                                            <li>
                                                <a href="{{ route('front.render.page', ['prefix' => $serviceMenu->prefix, 'lang' => app()->getLocale() != config()->get('app.defaultLocale') ? app()->getLocale() : null]) }}">{{ $serviceMenu->translation->name }}</a>
                                            </li>
                                        @endforeach
                                    </ul>
                                </li>
                            @endif
                            @if(isset($menu['projects']) && !empty($menu['projects']))
                                <li class="menu-item-has-children">
                                    <a class="" href="javascript:void(0);">{{ __('front::label.projects') }}</a>
                                    <ul class="sub-menu">
                                        @foreach($menu['projects'] as $projectMenu)
                                            <li>
                                                <a href="{{ route('front.render.page', ['prefix' => $projectMenu->prefix, 'lang' => app()->getLocale() != config()->get('app.defaultLocale') ? app()->getLocale() : null]) }}">{{ $projectMenu->translation->name }}</a>
                                            </li>
                                        @endforeach
                                    </ul>
                                </li>
                            @endif
                            @if(isset($languages) && !empty($languages))
                                @foreach($languages as $language)
                                    @if($language->prefix !== app()->getLocale())
                                        <li>
                                            <a href="{{ switchLocaleLinks(request()->getRequestUri(), strtolower($language->prefix)) }}">{{ strtoupper($language->prefix) }}</a>
                                        </li>
                                    @endif
                                @endforeach
                            @endif
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!--offcanvas menu area end-->
@endif

<!--header area start-->
<header class="header_section header_transparent sticky-header sticky">
    <div class="main_header">
        <div class="container-fluid bottom-line-shape">
            <div class="row">
                <div class="col-12">
                    <div class="header_container d-flex justify-content-between align-items-center">
                        <div class="header_logo">
                            @if(isMainPage())
                                <img src="{{ Module::asset('front:img/dzg2.png') }}" alt="" />
                            @else
                                <a class="sticky_none" href="{{ route('front.home', ['lang' => app()->getLocale() != config()->get('app.defaultLocale') ? app()->getLocale() : null]) }}">
                                    <img src="{{ Module::asset('front:img/dzg2.png') }}" alt="" />
                                </a>
                            @endif

                        </div>
                        <!--main menu start-->
                        <div class="main_menu d-none d-lg-block">
                            <nav>
                                <ul class="d-flex">
                                    <li>
                                        @if(isMainPage())
                                            <a class="active">{{ __('front::mainpage.home') }}</a>
                                        @else
                                            <a href="{{ route('front.home', ['lang' => app()->getLocale() != config()->get('app.defaultLocale') ? app()->getLocale() : null]) }}">{{ __('front::mainpage.home') }}</a>
                                        @endif
                                    </li>
                                    @if(isset($menu['top_menu']) && !empty($menu['top_menu']))
                                        @if(isset($menu['top_menu']->items) && !empty($menu['top_menu']->items))
                                            @foreach($menu['top_menu']->items as $menuItem)
                                                <li>
                                                    <a href="{{ generateLangLink($menuItem->url, app()->getLocale()) }}">{{ $menuItem->translation->label }}</a>
                                                </li>
                                            @endforeach
                                        @endif
                                    @endif
                                    @if(isset($menu['services']) && !empty($menu['services']))
                                        <li>
                                            <a class="">{{ __('front::label.services') }}</a>
                                                <ul class="sub_menu">
                                                    @foreach($menu['services'] as $serviceMenu)
                                                        <li>
                                                            <a href="{{ route('front.render.page', ['prefix' => $serviceMenu->prefix, 'lang' => app()->getLocale() != config()->get('app.defaultLocale') ? app()->getLocale() : null]) }}">{{ $serviceMenu->translation->name }}</a>
                                                        </li>
                                                    @endforeach
                                                </ul>
                                        </li>
                                    @endif
                                    @if(isset($menu['projects']) && !empty($menu['projects']))
                                        <li>
                                            <a class="" href="#">{{ __('front::label.projects') }}</a>
                                                <ul class="sub_menu">
                                                    @foreach($menu['projects'] as $projectMenu)
                                                        <li>
                                                            <a href="{{ route('front.render.page', ['prefix' => $projectMenu->prefix, 'lang' => app()->getLocale() != config()->get('app.defaultLocale') ? app()->getLocale() : null]) }}">{{ $projectMenu->translation->name }}</a>
                                                        </li>
                                                    @endforeach
                                                </ul>
                                        </li>
                                    @endif
                                </ul>
                            </nav>
                        </div>
                        <div class="main_menu d-none d-lg-block float-right">
                            <nav>
                                <ul class="d-flex">
                                    <li>
                                        <a href="javascript:void(0)">{{ strtoupper(app()->getLocale()) }}</a>
                                        @if(isset($languages) && !empty($languages))
                                            <ul class="sub_menu">
                                                @foreach($languages as $language)
                                                    @if($language->prefix !== app()->getLocale())
                                                        <li>
                                                            <a href="{{ switchLocaleLinks(request()->getRequestUri(), strtolower($language->prefix)) }}">{{ strtoupper($language->prefix) }}</a>
                                                        </li>
                                                    @endif
                                                @endforeach
                                            </ul>
                                        @endif
                                    </li>
                                </ul>
                            </nav>
                        </div>
                        <div class="main_header_right d-flex align-items-center">
                            <div class="canvas_open">
                                <a href="javascript:void(0)"><i class="ion-navicon"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>
<!--header area end-->
