<section class="portfolio_section mb-140">
    <div class="container-fluid">
        <div class="container">
            <div class="works_slide_header text-center">
                <div class="section_title">
                    <h2 class="wow fadeInUp" data-wow-delay="0.1s" data-wow-duration="1.1s" style="visibility: visible; animation-duration: 1.1s; animation-delay: 0.1s; animation-name: fadeInUp;">
                        {!! __('front::mainpage.main_directions', [], $langCode) !!}
                    </h2>
                </div>
            </div>
        </div>
        <div class="row no-gutters portfolio_page_gallery" style="position: relative; height: 1369.17px;">
            @if(isset($services) && !empty($services))
                @foreach($services as $service)
                    <div class="col-lg-4 col-md-6 col-sm-6 gird_item entertaiment life technology">
                        <figure class="portfolio_thumb wow fadeInUp" data-wow-delay="0.1s" data-wow-duration="1.1s" style="visibility: visible; animation-duration: 1.1s; animation-delay: 0.1s; animation-name: fadeInUp;">
                            <a href="{{$_COOKIE['mainLangCode'] != $_COOKIE['langCode'] ? "/{$_COOKIE['langCode']}" : null}}{{ route('front.render.page', ['prefix' => $service->prefix], false) }}">
                                <img src="/storage{{ $service->image }}" alt="{{ $service->translation->name }}">
                            </a>
                            <div class="portfolio_text">
                                <h3>{{ $service->translation->name }}</h3>
                            </div>
                        </figure>
                    </div>
                @endforeach
            @endif
        </div>
    </div>
</section>
