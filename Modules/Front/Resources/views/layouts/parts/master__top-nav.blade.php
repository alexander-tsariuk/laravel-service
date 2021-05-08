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
                                    <a href="#">Главная</a>
                                @else
                                    <a href="{{ route('front.home') }}">Главная</a>
                                @endif
                            </li>
                            <li class="menu-item-has-children">
                                <a href="about.html">About</a>
                            </li>
                            <li class="menu-item-has-children">
                                <a href="service.html">Service</a>
                            </li>
                            <li class="menu-item-has-children">
                                <a href="portfolio.html">Portfolio</a>
                                <ul class="sub-menu">
                                    <li><a href="portfolio.html">Portfolio</a></li>
                                    <li>
                                        <a href="single-portfolio.html">Single Portfolio</a>
                                    </li>
                                </ul>
                            </li>
                            <li class="menu-item-has-children">
                                <a href="#">Blog</a>
                                <ul class="sub-menu">
                                    <li><a href="blog.html">Blog</a></li>
                                    <li><a href="blog-details.html">Blog details</a></li>
                                </ul>
                            </li>
                            <li class="menu-item-has-children">
                                <a href="contact.html">Contact</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!--offcanvas menu area end-->

<!--header area start-->
<header class="header_section header_transparent sticky-header">
    <div class="main_header">
        <div class="container-fluid bottom-line-shape">
            <div class="row">
                <div class="col-12">
                    <div class="header_container d-flex justify-content-between align-items-center">
                        <div class="header_logo">
                            <a class="sticky_none" href="{{ request()->route()->getName() == 'front.home' ? '#' : route('front.home') }}">
                                <img src="{{ Module::asset('front:img/logo/logo.png') }}" alt="" />
                            </a>
                        </div>
                        <!--main menu start-->
                        <div class="main_menu d-none d-lg-block">
                            <nav>
                                <ul class="d-flex">
                                    <li>
                                        @if(request()->route()->getName() == 'front.home')
                                            <a class="active" href="#">Главная</a>
                                        @else
                                            <a class="active" href="{{ route('front.home') }}">Главная</a>
                                        @endif
                                    </li>
                                    @if(isset($menu['top_menu']) && !empty($menu['top_menu']))
                                        @if(isset($menu['top_menu']->items) && !empty($menu['top_menu']->items))
                                            @foreach($menu['top_menu']->items as $menuItem)
                                                <li>
                                                    <a href="{{ $menuItem->url }}">{{ $menuItem->translation->label }}</a>
                                                </li>
                                            @endforeach
                                        @endif
                                    @endif
                                    <li>
                                        <a class="" href="#">{{ __('front::label.services') }}</a>
                                        @if(isset($menu['services']) && !empty($menu['services']))
                                            <ul class="sub_menu">
                                                @foreach($menu['services'] as $serviceMenu)
                                                    <li>
                                                        <a href="{{ route('front.render.page', ['prefix' => $serviceMenu->prefix]) }}">{{ $serviceMenu->translation->name }}</a>
                                                    </li>
                                                @endforeach
                                            </ul>
                                        @endif
                                    </li>
                                    <li>
                                        <a class="" href="#">{{ __('front::label.projects') }}</a>
                                        @if(isset($menu['projects']) && !empty($menu['projects']))
                                            <ul class="sub_menu">
                                                @foreach($menu['projects'] as $projectMenu)
                                                    <li>
                                                        <a href="{{ route('front.render.page', ['prefix' => $projectMenu->prefix]) }}">{{ $projectMenu->translation->name }}</a>
                                                    </li>
                                                @endforeach
                                            </ul>
                                        @endif
                                    </li>
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
                                                            <a href="{{ generateLangLink(request()->getRequestUri(), strtolower($language->prefix)) }}">{{ strtoupper($language->prefix) }}</a>
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
