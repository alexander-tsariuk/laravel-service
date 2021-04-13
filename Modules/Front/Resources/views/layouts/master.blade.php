<!DOCTYPE html>
<html class="no-js" lang="ru">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="x-ua-compatible" content="ie=edge" />
    <title>{{ $seo->title ?? ''}} | {{ $sitename }}</title>

    @if(isset($seo->description) && !empty($seo->description))
        <meta name="description" content="{{ $seo->description  }}" />
    @endif
    @if(isset($seo->keywords) && !empty($seo->keywords))
        <meta name="keywords" content="{{ $seo->keywords  }}" />
    @endif

    <meta name="viewport" content="width=device-width, initial-scale=1" />

    <link rel="profile" href="https://gmpg.org/xfn/11" />
    <link rel="canonical" href="{{ $siteurl }}" />

    @if(isset($seo->robots) && !empty($seo->robots))
        <meta name="robots" content="{{ $seo->robots }}" />
    @endif

    <!-- Open Graph (OG) meta tags are snippets of code that control how URLs are displayed when shared on social media  -->
    <meta property="og:locale" content="ru_RU" />
    <meta property="og:type" content="website" />
    <meta property="og:title" content="{{ $seo->title ?? ''}} | {{ $sitename }}" />
    <meta property="og:url" content="{{ $siteurl }}" />
    <meta property="og:site_name" content="{{ $sitename }}" />
    <!-- For the og:image content, replace the # with a link of an image -->
    <meta property="og:image" content="#" />

    @if(isset($seo->description) && !empty($seo->description))
        <meta property="og:description" content="{{ $seo->description }}" />
    @endif

    @if(isset($seo->keywords) && !empty($seo->keywords))
        <meta property="og:keywords" content="{{ $seo->keywords }}" />
    @endif

    <!-- Add site Favicon -->
    <link rel="icon" href="https://hasthemes.com/wp-content/uploads/2019/04/cropped-favicon-32x32.png" sizes="32x32" />
    <link rel="icon" href="https://hasthemes.com/wp-content/uploads/2019/04/cropped-favicon-192x192.png"
          sizes="192x192" />
    <link rel="apple-touch-icon" href="https://hasthemes.com/wp-content/uploads/2019/04/cropped-favicon-180x180.png" />
    <meta name="msapplication-TileImage"
          content="https://hasthemes.com/wp-content/uploads/2019/04/cropped-favicon-270x270.png" />

    <!-- Structured Data  -->
    <script type="application/ld+json">
			{
				"@context": "http://schema.org",
				"@type": "WebSite",
				"name": "{{ $sitename }}",
				"url": "{{ $siteurl }}"
			}
	</script>

    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">

    <link rel="stylesheet" href="{{ Module::asset('dashboard:plugins/fontawesome-free/css/all.min.css') }}">

    <!-- vendor css (Bootstrap & Icon Font) -->
    <link rel="stylesheet" href="{{ Module::asset('front:css/vendor/bootstrap.min.css') }}" />
    <link rel="stylesheet" href="{{ Module::asset('front:css/vendor/elegant-icons.min.css') }}" />
    <link rel="stylesheet" href="{{ Module::asset('front:css/vendor/ionicons.min.css') }}" />

    <!-- plugins css (All Plugins Files) -->
    <link rel="stylesheet" href="{{ Module::asset('front:css/plugins/animate.css') }}" />
    <link rel="stylesheet" href="{{ Module::asset('front:css/plugins/swiper-bundle.min.css') }}" />
    <link rel="stylesheet" href="{{ Module::asset('front:css/plugins/magnific-popup.css') }}" />

    <!-- Main Style -->
    <link rel="stylesheet" href="{{ Module::asset('front:css/style.css') }}" />

    <link rel="stylesheet" href="{{ Module::asset('front:css/slider.css') }}" />
</head>

<body>

@include('front::layouts.parts.master__top-nav')


@yield('content')

<section class="team_members_section">
    <div class="container">
        <div class="row">
            <div class="col-12">
                {!! isset($settings['mainpage']['map_code']) && !empty($settings['mainpage']['map_code']->content) ? trim($settings['mainpage']['map_code']->content) : '' !!}
            </div>
        </div>
    </div>
</section>

<!--footer area start-->
<footer class="footer_widgets">
    <div class="container">
        <div class="section_title text-center position-relative mb-66">
            <h2>Drop Us <span>A Line</span></h2>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="footer_inner position-relative">

                    <div class="main_footer d-flex justify-content-between">
                        <div class="footer_widget_list footer_menu mb-lm-30px">
                            <ul>
                                <li><a href="#">Site Map</a></li>
                                <li><a href="#">Term & Conditions</a></li>
                                <li><a href="#">Privacy Policy</a></li>
                                <li><a href="#">Help</a></li>
                                <li><a href="#">Press</a></li>
                            </ul>
                        </div>
                        <div class="footer_widget_list footer_menu mb-lm-30px">
                            <ul>
                                <li><a href="#">Our Location</a></li>
                                <li><a href="#">Career</a></li>
                                <li><a href="about.html">About</a></li>
                                <li><a href="contact.html">Contact</a></li>
                            </ul>
                        </div>
                        <div class="footer_widget_list footer_menu mb-xs-30px">
                            <ul>
                                <li><a href="#">FAQs</a></li>
                                <li><a href="blog.html">Blog</a></li>
                                <li><a href="#">Car Blog</a></li>
                                <li><a href="#">Location</a></li>
                                <li><a href="#">Press</a></li>
                            </ul>
                        </div>
                        <div class="footer_widget_list newsletter_subscribe">
                            <p>Sign up for get our newsletter</p>
                            <!-- News letter area -->
                            <div id="mc_embed_signup" class="subscribe-form">
                                <form id="mc-embedded-subscribe-form" class="validate" novalidate="" target="_blank"
                                      name="mc-embedded-subscribe-form" method="post"
                                      action="http://devitems.us11.list-manage.com/subscribe/post?u=6bbb9b6f5827bd842d9640c82&amp;id=05d85f18ef">
                                    <div id="mc_embed_signup_scroll" class="mc-form">
                                        <input class="email" type="email" required="" placeholder="Your Mail*"
                                               name="EMAIL" value="" />
                                        <div class="mc-news" aria-hidden="true">
                                            <input type="text" value="" tabindex="-1"
                                                   name="b_6bbb9b6f5827bd842d9640c82_05d85f18ef" />
                                        </div>
                                        <div class="clear">
                                            <button id="mc-embedded-subscribe" class="border-0" type="submit"
                                                    name="subscribe" value=""><i class="ei ei-arrow_right"></i></button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <!-- News letter area  End -->
                            <!-- mailchimp-alerts Start -->
                            <div class="mailchimp-alerts text-centre">
                                <div class="mailchimp-submitting"></div>
                                <!-- mailchimp-submitting end -->
                                <div class="mailchimp-success"></div>
                                <!-- mailchimp-success end -->
                                <div class="mailchimp-error"></div>
                                <!-- mailchimp-error end -->
                            </div>
                            <!-- mailchimp-alerts end -->
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
    </div>
</footer>
<!--footer area end-->



<!-- Global Vendor, plugins JS -->

<!-- Vendor JS -->
<script src="{{Module::asset("front:js/vendor/jquery-3.5.1.min.js")}}"></script>
<script src="{{Module::asset("front:js/vendor/popper.min.js")}}"></script>
<script src="{{Module::asset("front:js/vendor/bootstrap.min.js")}}"></script>
<script src="{{Module::asset("front:js/vendor/jquery-migrate-3.3.0.min.js")}}"></script>
<script src="{{Module::asset("front:js/vendor/modernizr-3.11.2.min.js")}}"></script>

<!--Plugins JS-->
<script src="{{Module::asset("front:js/plugins/swiper-bundle.min.js")}}"></script>
<script src="{{Module::asset("front:js/plugins/wow.min.js")}}"></script>
<script src="{{Module::asset("front:js/plugins/jquery.scrollup.min.js")}}"></script>
<script src="{{Module::asset("front:js/plugins/images-loaded.min.js")}}"></script>
<script src="{{Module::asset("front:js/plugins/isotope.pkgd.min.js")}}"></script>
<script src="{{Module::asset("front:js/plugins/tippy-bundle.umd.js")}}"></script>
<script src="{{Module::asset("front:js/plugins/jquery.magnific-popup.min.js")}}"></script>
<script src="{{Module::asset("front:js/plugins/mailchimp-ajax.js")}}"></script>
<script src="{{Module::asset("front:js/plugins/jquery.counterup.min.js")}}"></script>
<script src="{{Module::asset("front:js/plugins/jquery-waypoints.js")}}"></script>

<!-- Use the minified version files listed below for better performance and remove the files listed above -->
<!-- <script src="{{Module::asset("front:js/vendor/vendor.min.js")}}"></script>
<script src="{{Module::asset("front:js/plugins/plugins.min.js")}}"></script> -->

<!-- Main Js -->
<script src="{{Module::asset("front:js/main.js")}}"></script>

<script src="{{Module::asset("front:js/slider.js")}}"></script>

</body>

</html>
