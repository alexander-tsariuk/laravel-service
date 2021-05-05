@extends('front::layouts.master')

@section('content')
    <div class="hero_banner_section hero_banner2 hero-overlay  d-flex align-items-center"
         style="background-image: url('/storage{{$project->image}}'); min-height: 800px;height: auto !important;">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="hero_banner_inner">
                        <div class="hero_content text-center pb-0  mt-5">
                            <h1
                                class="text-white wow fadeInUp"
                                data-wow-delay="0.1s"
                                data-wow-duration="1.1s"
                                style="visibility: visible; animation-duration: 1.1s; animation-delay: 0.1s; animation-name: fadeInUp;"
                            >{{ isset($project->h1) && !empty($project->h1) ? $project->h1 : $project->translation->name }}</h1>

                            @if(isset($project->translation->short_description) && !empty($project->translation->short_description))
                                <p
                                    class="mb-0 wow fadeInUp"
                                    data-wow-delay="0.2s"
                                    data-wow-duration="1.2s"
                                    style="visibility: visible; animation-duration: 1.2s; animation-delay: 0.2s; animation-name: fadeInUp;"
                                >{{ $project->translation->short_description }}</p>
                            @endif

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <section class="project_details_section mt-5 mb-5">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="project_details_inner">
                        <div class="project_details_desc">
                            <div class="project_desc_list">{!! $project->translation->content !!}</div>

                            <div class="project_desc_popou d-flex justify-content-between mt-5">
                                <div class="popou_thumb_list wow fadeInUp" data-wow-delay="0.1s" data-wow-duration="1.1s" style="visibility: visible; animation-duration: 1.1s; animation-delay: 0.1s; animation-name: fadeInUp;">
                                    <a class="port_popup" href="https://htmldemo.hasthemes.com/asore/asore/assets/img/others/single-post2.jpg">
                                        <img class="w-100" src="https://htmldemo.hasthemes.com/asore/asore/assets/img/others/single-post2.jpg" alt="">
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
