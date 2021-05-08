<div class="row">
    <div class="col-12">
        <div class="footer_inner position-relative">
            <div class="main_footer d-flex justify-content-between">
                <div class="footer_widget_list footer_menu mb-lm-30px">
                    <ul>
                        <li>
                            <a href="{{ route('front.home') }}">Главная</a>
                        </li>

                        @if(isset($menu['bottom_menu']) && !empty($menu['bottom_menu']))
                            @if(isset($menu['bottom_menu']->items) && !empty($menu['bottom_menu']->items))
                                @foreach($menu['bottom_menu']->items as $menuItem)
                                    <li>
                                        <a href="{{ $menuItem->url }}">{{ $menuItem->translation->label }}</a>
                                    </li>
                                @endforeach
                            @endif
                        @endif
                    </ul>
                </div>
                <div class="footer_widget_list footer_menu mb-lm-30px">
                    @if(isset($menu['services']) && !empty($menu['services']))
                        <ul>
                            @foreach($menu['services'] as $serviceMenu)
                                <li>
                                    <a href="{{ route('front.render.page', ['prefix' => $serviceMenu->prefix]) }}">{{ $serviceMenu->translation->name }}</a>
                                </li>
                            @endforeach
                        </ul>
                    @endif
                </div>

                <div class="footer_widget_list footer_menu mb-xs-30px">
                    @if(isset($menu['projects']) && !empty($menu['projects']))
                        <ul>
                            @foreach($menu['projects'] as $projectMenu)
                                <li>
                                    <a href="{{ route('front.render.page', ['prefix' => $projectMenu->prefix]) }}">{{ $projectMenu->translation->name }}</a>
                                </li>
                            @endforeach
                        </ul>
                    @endif
                </div>
                <div class="footer_widget_list newsletter_subscribe">
                </div>
            </div>
            <div class="footer_bottom d-flex justify-content-between align-items-center">
                <div class="footer_bottom_left d-flex align-items-end">
                    <div class="footer_logo">
                        <a href="#"><img src="{{ Module::asset('front:img/logo/footer-logo.png') }}" alt="" /></a>
                    </div>
                    <div class="copyright_right">
                        <p>
                            текст в футере
                        </p>
                    </div>
                </div>
                <div class="footer_social">
                    <ul class="d-flex">
                        <li>
                            <a href="https://twitter.com" data-tippy="Twitter" data-tippy-inertia="true"
                               data-tippy-delay="50" data-tippy-arrow="true" data-tippy-placement="top"><i
                                    class="ei ei-social_twitter"></i></a>
                        </li>
                        <li>
                            <a href="https://www.facebook.com" data-tippy="Facebook"
                               data-tippy-inertia="true" data-tippy-delay="50" data-tippy-arrow="true"
                               data-tippy-placement="top"><i class="ei ei-social_facebook"></i></a>
                        </li>
                        <li>
                            <a href="https://www.google.com" data-tippy="googleplus"
                               data-tippy-inertia="true" data-tippy-delay="50" data-tippy-arrow="true"
                               data-tippy-placement="top"><i class="ei ei-social_googleplus"></i></a>
                        </li>
                        <li>
                            <a href="https://www.instagram.com" data-tippy="Linkedin"
                               data-tippy-inertia="true" data-tippy-delay="50" data-tippy-arrow="true"
                               data-tippy-placement="top"><i class="ei ei-social_linkedin"></i></a>
                        </li>
                        <li>
                            <a href="https://www.youtube.com" data-tippy="Ress" data-tippy-inertia="true"
                               data-tippy-delay="50" data-tippy-arrow="true" data-tippy-placement="top"><i
                                    class="ei ei-social_rss"></i></a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
