@extends('front::layouts.master')

@section('content')
    <div class="hero-section section overlay"
         style="background-image: url('/storage{{$service->image}}'); min-height: 800px;height: auto !important;">
        <div class="container">
            <div class="row">
                <div class="hero-content text-center col-12"></div>
            </div>
        </div>
    </div>
    <section class="portfolio_section mb-140">
        <div class="container-fluid">
            <div class="container">
                <div class="works_slide_header text-center">
                    <div class="section_title">
                        <h1>{{ isset($seo->h1) && !empty($seo->h1) ? $seo->h1 : $service->translation->name }}</h1>
                    </div>
                </div>
            </div>
            <div class="row no-gutters portfolio_page_gallery" style="position: relative; height: 1369.17px;">
                @if(isset($projects) && !empty($projects))
                    @foreach($projects as $project)
                        <div class="col-lg-4 col-md-6 col-sm-6 gird_item entertaiment life technology">
                            <figure class="portfolio_thumb wow fadeInUp" data-wow-delay="0.1s" data-wow-duration="1.1s" style="visibility: visible; animation-duration: 1.1s; animation-delay: 0.1s; animation-name: fadeInUp;">
                                <a href="{{$_COOKIE['mainLangCode'] != $_COOKIE['langCode'] ? "/{$_COOKIE['langCode']}" : null}}{{ route('front.render.page', ['prefix' => $project->prefix], false) }}">
                                    <img src="/storage{{ $project->image }}" alt="{{ $project->translation->name }}">
                                </a>
                                <div class="portfolio_text">
                                    <h3>{{ $project->translation->name }}</h3>
                                </div>
                            </figure>
                        </div>
                    @endforeach
                @elseif(isset($subServices) && !empty($subServices))
                    @foreach($subServices as $subService)
                        <div class="col-lg-4 col-md-6 col-sm-6 gird_item entertaiment life technology">
                            <figure class="portfolio_thumb wow fadeInUp" data-wow-delay="0.1s" data-wow-duration="1.1s" style="visibility: visible; animation-duration: 1.1s; animation-delay: 0.1s; animation-name: fadeInUp;">
                                <a href="{{$_COOKIE['mainLangCode'] != $_COOKIE['langCode'] ? "/{$_COOKIE['langCode']}" : null}}{{ route('front.render.page', ['prefix' => $service->prefix, 'subPrefix' => $subService->prefix],false) }}">
                                    <img src="/storage{{ $subService->image }}" alt="{{ $subService->translation->name }}">
                                </a>
                                <div class="portfolio_text">
                                    <h3>{{ $subService->translation->name }}</h3>
                                </div>
                            </figure>
                        </div>
                    @endforeach
                @endif
            </div>
        </div>
    </section>

@endsection
