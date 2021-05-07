@if(isset($slides) && !empty($slides))
    <section class="hero_banner_section d-flex " id="slider-block">
        <div id="viewport">
            <ul id="slidewrapper">
                @foreach($slides as $slide)
                    <li class="slide">
                        <section class="hero_banner_section d-flex slide-item" data-bgimg="/storage{{ $slide->image }}">
                            <div class="container align-self-center">
                                <div class="row">
                                    <div class="col-12">
                                        <div class="hero_banner_inner">
                                            <div class="hero_content text-center">
                                                <h1 class="text-white wow fadeInUp" data-wow-delay="0.1s"
                                                    data-wow-duration="1.1s">{{ $slide->translation->heading_text }}</h1>
                                                @if(isset($slide->translation->description) && !empty($slide->translation->description))
                                                    <p class="wow fadeInUp" data-wow-delay="0.2s"
                                                       data-wow-duration="1.2s">{{ $slide->translation->description }}</p>
                                                @endif

                                                @if(isset($slide->translation->link) && !empty($slide->translation->link) && isset($slide->translation->text_of_link) && !empty($slide->translation->text_of_link))
                                                    <a class="btn btn-link wow fadeInUp" data-wow-delay="0.3s"
                                                    data-wow-duration="1.3s"
                                                    href="{{ $slide->translation->link }}">{{ $slide->translation->text_of_link }}</a>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </section>
                    </li>
                @endforeach
            </ul>

            <div id="prev-next-btns">
                <i class="fas fa-angle-left" aria-hidden="true" style="color: #000;"></i>
                <i class="fa fa-angle-right" aria-hidden="true" style="color: #000;"></i>
            </div>
        </div>
    </section>
@endif
