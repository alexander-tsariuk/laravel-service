@if(isset($settings['mainpage']['about_us_'.$langCode]) && !empty($settings['mainpage']['about_us_'.$langCode]->content))

    <section class="blog_section">
        <div class="container">
            <div class="section_title text-center mb-66">
                <h2 class="wow fadeInUp" data-wow-delay="0.1s" data-wow-duration="1.1s" style="visibility: visible; animation-duration: 1.1s; animation-delay: 0.1s; animation-name: fadeInUp;">
                    {!! __('front::mainpage.about_us', [], $langCode) !!}
                </h2>
            </div>
            <div class="blog_container swiper-container swiper-container-initialized swiper-container-horizontal">
                {!! $settings['mainpage']['about_us_'.$langCode]->content !!}
            </div>
        </div>
    </section>
@endif
