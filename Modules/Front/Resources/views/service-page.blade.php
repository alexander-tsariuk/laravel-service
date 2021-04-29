@extends('front::layouts.master')

@section('content')
    <div class="hero_banner_section hero_banner2 hero-overlay  d-flex align-items-center"
         style="background-image: url('/storage{{$service->image}}'); min-height: 800px;height: auto !important;">
        <div class="container">

            <div class="row">
                <div class="col-12">
                    <div class="hero_banner_inner mt-5">
                        <div class="hero_content text-center pb-0">
                            <h1
                                class="text-white wow fadeInUp"
                                data-wow-delay="0.1s"
                                data-wow-duration="1.1s"
                                style="visibility: visible; animation-duration: 1.1s; animation-delay: 0.1s; animation-name: fadeInUp;"
                            >{{ isset($seo->h1) && !empty($seo->h1) ? $seo->h1 : $service->translation->name }}</h1>

                            @if(isset($service->translation->short_description) && !empty($service->translation->short_description))
                                <p
                                    class="mb-0 wow fadeInUp"
                                    data-wow-delay="0.2s"
                                    data-wow-duration="1.2s"
                                    style="visibility: visible; animation-duration: 1.2s; animation-delay: 0.2s; animation-name: fadeInUp;"
                                >{{ $service->translation->short_description }}</p>
                            @endif

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <section class="portfolio_section mb-140">
        <div class="container-fluid px-0 py-0 mx-0 my-0">
            <div class="section_title text-center mb-96">
                <h2 class="wow fadeInUp" data-wow-delay="0.2s" data-wow-duration="1.2s" style="visibility: visible; animation-duration: 1.2s; animation-delay: 0.2s; animation-name: fadeInUp;">{{ __('front::label.completed_projects', [], app()->getLocale()) }}</h2>
            </div>
            <div class="d-flex flex-row mx-0 my-0 py-0 px-0">
                @if(isset($projects) && !empty($projects))
                    <div id="projects-container" class="d-flex flex-wrap col-12 col-md-12 col-sm-12 col-lg-12 py-0 px-0 mx-0 my-0">
                        @foreach($projects as $project)
                            <div class="col-4 flex-fill bd-highlight  py-0 px-0 mx-0 my-0" style="max-height: 423px;overflow: hidden;width: 33.33333%;">
                                <figure class="portfolio_thumb wow fadeInUp" data-wow-delay="0.1s" data-wow-duration="1.1s" style="position: relative; visibility: visible; animation-duration: 1.1s; animation-delay: 0.1s; animation-name: fadeInUp;">
                                    <a href="{{config()->get('app.defaultLocale') != config()->get('app.locale') ? "/".config()->get('app.locale') : null}}{{ route('front.render.page', ['prefix' => $project->prefix], false) }}">
                                        <img src="/storage{{ $project->image }}" alt="{{ $project->translation->name }}">
                                    </a>
                                    <div class="portfolio_text">
                                        <h3>{{ $project->translation->name }}</h3>
                                    </div>
                                </figure>
                            </div>
                        @endforeach
                    </div>
                @elseif(isset($subServices) && !empty($subServices))
                    @foreach($subServices as $subService)
                        <div class="col-4 flex-fill bd-highlight  py-0 px-0 mx-0 my-0" style="max-height: 423px;overflow: hidden;width: 33.33333%;">
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
            @if(isset($projects) && !empty($projects))
                <div class="row no-gutters portfolio_page_gallery mt-5">
                    <div class="col-lg-12 col-md-12 col-sm-12 text-center">
                        <a href="#" class="projects-load btn btn-link" data-page="1" data-service="{{ $service->id }}">
                            <span class="txt">{{ __('front::label.load_more', [], app()->getLocale()) }}</span>
                        </a>
                    </div>
                </div>
            @endif
        </div>
    </section>

@endsection
