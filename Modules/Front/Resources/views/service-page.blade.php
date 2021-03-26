@extends('front::layouts.master')

@section('content')
    <section class="portfolio_section mb-140">
        <div class="container-fluid">
            <div class="container">
                <div class="works_slide_header text-center">
                    <div class="section_title">
                        <h1>{{ $service->translation->name }}</h1>
                    </div>
                </div>
            </div>
            <div class="row no-gutters portfolio_page_gallery" style="position: relative; height: 1369.17px;">
                @if(isset($projects) && !empty($projects))
                    @foreach($projects as $project)
                        <div class="col-lg-4 col-md-6 col-sm-6 gird_item entertaiment life technology">
                            <figure class="portfolio_thumb wow fadeInUp" data-wow-delay="0.1s" data-wow-duration="1.1s" style="visibility: visible; animation-duration: 1.1s; animation-delay: 0.1s; animation-name: fadeInUp;">
                                <a href="{{ route('front.project.page', ['prefix' => $project->prefix]) }}">
                                    <img src="/storage{{ $project->image }}" alt="{{ $project->translation->name }}">
                                </a>
                                <div class="portfolio_text">
                                    <h3>{{ $project->translation->name }}</h3>
                                </div>
                            </figure>
                        </div>
                    @endforeach
                @endif
            </div>
            <div class="loding_bar text-center">
                <i class="ion-load-a icons"></i>
                <a href="#">loading</a>
            </div>
        </div>
    </section>

@endsection
