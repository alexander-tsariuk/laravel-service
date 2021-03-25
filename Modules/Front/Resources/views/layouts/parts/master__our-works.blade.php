@if(isset($ourWorks) && !empty($ourWorks))
<!-- product section start -->
<section class="works_slide_section section-pdding-top section-pdding-bottom">
    <div class="container">
        <div class="works_slide_header text-center">
            <div class="section_title">
                <h2>Наши <span>работы</span></h2>
            </div>
        </div>
    </div>
    <div class="works_slide_container">
        <div class="tab-content">
            <div class="tab-pane fade show active" id="all" role="tabpanel">
                <div class="works_slide_wrapper text-center swiper-container">
                    <div class="work_slider_inner swiper-wrapper">
                        @foreach($ourWorks as $ourWork)
                            <div class="works_slick_list swiper-slide">
                                <a href="#">
                                    <img src="/storage{{$ourWork->image}}" alt="" />
                                </a>
                                <div class="work_slick_text">
                                    <h2 class="title">
                                        <a class="title-link" href="#">{{ $ourWork->translation->name }}</a>
                                    </h2>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    <!-- Add Scrollbar -->
                    <div class="swiper-scrollbar"></div>
                </div>
            </div>
        </div>
    </div>
    <div class="view_all_works text-center">
        <a href="#">Все работы</a>
    </div>
</section>
<!-- product section end -->
@endif
