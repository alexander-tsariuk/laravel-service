@extends('front::layouts.master')

@section('content')
    <div class="hero-section section overlay"
         style="background-image: url('/storage{{$project->image}}'); min-height: 800px;height: auto !important;">
        <div class="container">
            <div class="row">
                <div class="hero-content text-center col-12"></div>
            </div>
        </div>
    </div>
    <section class="brand_archo_section mb-135 mt-4">
        <div class="container">
            <div class="section_title text-center mb-96">
                <h1 class="wow fadeInUp" data-wow-delay="0.2s" data-wow-duration="1.2s" style="visibility: visible; animation-duration: 1.2s; animation-delay: 0.2s; animation-name: fadeInUp;">{{ isset($seo->h1) && !empty($seo->h1) ? $seo->h1 : $project->translation->name }}</h1>
            </div>
        </div>
    </section>
    <section class="project_details_section">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="project_details_inner">
                        <div class="project_details_desc">
                            <div class="project_desc_list">{!! $project->translation->content !!}</div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
