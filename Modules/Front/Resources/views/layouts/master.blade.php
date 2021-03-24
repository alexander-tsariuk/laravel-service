<!DOCTYPE html>
<html class="no-js" lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="x-ua-compatible" content="ie=edge" />
    <title>Asore – Business Bootstrap 5 Template</title>
    <meta name="description"
          content="240+ Best Bootstrap Templates are available on this website. Find your template for your project compatible with the most popular HTML library in the world." />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link rel="profile" href="https://gmpg.org/xfn/11" />
    <link rel="canonical" href="https://htmldemo.hasthemes.com/asore-preview//" />

    <!-- Open Graph (OG) meta tags are snippets of code that control how URLs are displayed when shared on social media  -->
    <meta property="og:locale" content="en_US" />
    <meta property="og:type" content="website" />
    <meta property="og:title" content="Asore – Business Bootstrap 5 Template" />
    <meta property="og:url" content="https://htmldemo.hasthemes.com/asore-preview//" />
    <meta property="og:site_name" content="Asore – Business Bootstrap 5 Template" />
    <!-- For the og:image content, replace the # with a link of an image -->
    <meta property="og:image" content="#" />
    <meta property="og:description"
          content="240+ Best Bootstrap Templates are available on this website. Find your template for your project compatible with the most popular HTML library in the world." />

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
				"name": "Replace_with_your_site_title",
				"url": "Replace_with_your_site_URL"
			}
	</script>

    <!-- vendor css (Bootstrap & Icon Font) -->
    <link rel="stylesheet" href="{{ Module::asset('front:css/vendor/bootstrap.min.css') }}" />
    <link rel="stylesheet" href="{{ Module::asset('front:css/vendor/elegant-icons.min.css') }}" />
    <link rel="stylesheet" href="{{ Module::asset('front:css/vendor/ionicons.min.css') }}" />

    <!-- plugins css (All Plugins Files) -->
    <link rel="stylesheet" href="{{ Module::asset('front:css/plugins/animate.css') }}" />
    <link rel="stylesheet" href="{{ Module::asset('front:css/plugins/swiper-bundle.min.css') }}" />
    <link rel="stylesheet" href="{{ Module::asset('front:css/plugins/magnific-popup.css') }}" />

    <!-- Use the minified version files listed below for better performance and remove the files listed above -->
    <!-- <link rel="stylesheet" href="{{ Module::asset('front:css/vendor/vendor.min.css') }}" />
    <link rel="stylesheet" href="{{ Module::asset('front:css/plugins/plugins.min.css') }}" />
    <link rel="stylesheet" href="css/style.min.css"> -->

    <!-- Main Style -->
    <link rel="stylesheet" href="{{ Module::asset('front:css/style.css') }}" />

    <link rel="stylesheet" href="{{ Module::asset('front:css/slider.css') }}" />
</head>

<body>

@include('front::layouts.parts.master__top-nav')
@include('front::layouts.parts.master__top-slider')

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
                        <div class="works_slick_list swiper-slide">
                            <a href="portfolio.html">
                                <img src="{{ Module::asset('front:img/others/slide-img1.jpg') }}" alt="" />
                            </a>
                            <div class="work_slick_text">
                                <h2 class="title">
                                    <a class="title-link" href="portfolio.html">Lawa Lawyers Firm</a>
                                </h2>

                            </div>
                        </div>
                        <div class="works_slick_list swiper-slide">
                            <a href="portfolio.html"><img src="{{ Module::asset('front:img/others/slide-img2.jpg') }}" alt="" /></a>
                            <div class="work_slick_text">
                                <h2 class="title">
                                    <a class="title-link" href="portfolio.html">Lawa Lawyers Firm</a>
                                </h2>

                            </div>
                        </div>
                        <div class="works_slick_list swiper-slide">
                            <a href="portfolio.html"><img src="{{ Module::asset('front:img/others/slide-img3.jpg') }}" alt="" /></a>
                            <div class="work_slick_text">
                                <h2 class="title">
                                    <a class="title-link" href="portfolio.html">Lawa Lawyers Firm</a>
                                </h2>

                            </div>
                        </div>
                        <div class="works_slick_list swiper-slide">
                            <a href="portfolio.html"><img src="{{ Module::asset('front:img/others/slide-img1.jpg') }}" alt="" /></a>
                            <div class="work_slick_text">
                                <h2 class="title">
                                    <a class="title-link" href="portfolio.html">Lawa Lawyers Firm</a>
                                </h2>

                            </div>
                        </div>
                    </div>
                    <!-- Add Scrollbar -->
                    <div class="swiper-scrollbar"></div>
                </div>
            </div>
            <div class="tab-pane fade" id="branding" role="tabpanel">
                <div class="works_slide_wrapper text-center swiper-container">
                    <div class="work_slider_inner swiper-wrapper">
                        <div class="works_slick_list swiper-slide">
                            <a href="portfolio.html"><img src="{{ Module::asset('front:img/others/slide-img1.jpg') }}" alt="" /></a>
                            <div class="work_slick_text">
                                <h2 class="title">
                                    <a class="title-link" href="portfolio.html">Lawa Lawyers Firm</a>
                                </h2>

                            </div>
                        </div>
                        <div class="works_slick_list swiper-slide">
                            <a href="portfolio.html"><img src="{{ Module::asset('front:img/others/slide-img2.jpg') }}" alt="" /></a>
                            <div class="work_slick_text">
                                <h2 class="title">
                                    <a class="title-link" href="portfolio.html">Lawa Lawyers Firm</a>
                                </h2>

                            </div>
                        </div>
                        <div class="works_slick_list swiper-slide">
                            <a href="portfolio.html"><img src="{{ Module::asset('front:img/others/slide-img3.jpg') }}" alt="" /></a>
                            <div class="work_slick_text">
                                <h2 class="title">
                                    <a class="title-link" href="portfolio.html">Lawa Lawyers Firm</a>
                                </h2>

                            </div>
                        </div>
                        <div class="works_slick_list swiper-slide">
                            <a href="portfolio.html"><img src="{{ Module::asset('front:img/others/slide-img1.jpg') }}" alt="" /></a>
                            <div class="work_slick_text">
                                <h2 class="title">
                                    <a class="title-link" href="portfolio.html">Lawa Lawyers Firm</a>
                                </h2>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="tab-pane fade" id="design" role="tabpanel">
                <div class="works_slide_wrapper text-center swiper-container">
                    <div class="work_slider_inner swiper-wrapper">
                        <div class="works_slick_list swiper-slide">
                            <a href="portfolio.html"><img src="{{ Module::asset('front:img/others/slide-img1.jpg') }}" alt="" /></a>
                            <div class="work_slick_text">
                                <h2 class="title">
                                    <a class="title-link" href="portfolio.html">Lawa Lawyers Firm</a>
                                </h2>

                            </div>
                        </div>
                        <div class="works_slick_list swiper-slide">
                            <a href="portfolio.html"><img src="{{ Module::asset('front:img/others/slide-img2.jpg') }}" alt="" /></a>
                            <div class="work_slick_text">
                                <h2 class="title">
                                    <a class="title-link" href="portfolio.html">Lawa Lawyers Firm</a>
                                </h2>

                            </div>
                        </div>
                        <div class="works_slick_list swiper-slide">
                            <a href="portfolio.html"><img src="{{ Module::asset('front:img/others/slide-img3.jpg') }}" alt="" /></a>
                            <div class="work_slick_text">
                                <h2 class="title">
                                    <a class="title-link" href="portfolio.html">Lawa Lawyers Firm</a>
                                </h2>

                            </div>
                        </div>
                        <div class="works_slick_list swiper-slide">
                            <a href="portfolio.html"><img src="{{ Module::asset('front:img/others/slide-img1.jpg') }}" alt="" /></a>
                            <div class="work_slick_text">
                                <h2 class="title">
                                    <a class="title-link" href="portfolio.html">Lawa Lawyers Firm</a>
                                </h2>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="tab-pane fade" id="photography" role="tabpanel">
                <div class="works_slide_wrapper text-center swiper-container">
                    <div class="work_slider_inner swiper-wrapper">
                        <div class="works_slick_list swiper-slide">
                            <a href="portfolio.html"><img src="{{ Module::asset('front:img/others/slide-img1.jpg') }}" alt="" /></a>
                            <div class="work_slick_text">
                                <h2 class="title">
                                    <a class="title-link" href="portfolio.html">Lawa Lawyers Firm</a>
                                </h2>

                            </div>
                        </div>
                        <div class="works_slick_list swiper-slide">
                            <a href="portfolio.html"><img src="{{ Module::asset('front:img/others/slide-img2.jpg') }}" alt="" /></a>
                            <div class="work_slick_text">
                                <h2 class="title">
                                    <a class="title-link" href="portfolio.html">Lawa Lawyers Firm</a>
                                </h2>

                            </div>
                        </div>
                        <div class="works_slick_list swiper-slide">
                            <a href="portfolio.html"><img src="{{ Module::asset('front:img/others/slide-img3.jpg') }}" alt="" /></a>
                            <div class="work_slick_text">
                                <h2 class="title">
                                    <a class="title-link" href="portfolio.html">Lawa Lawyers Firm</a>
                                </h2>

                            </div>
                        </div>
                        <div class="works_slick_list swiper-slide">
                            <a href="portfolio.html"><img src="{{ Module::asset('front:img/others/slide-img1.jpg') }}" alt="" /></a>
                            <div class="work_slick_text">
                                <h2 class="title">
                                    <a class="title-link" href="portfolio.html">Lawa Lawyers Firm</a>
                                </h2>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="tab-pane fade" id="animation" role="tabpanel">
                <div class="works_slide_wrapper text-center swiper-container">
                    <div class="work_slider_inner swiper-wrapper">
                        <div class="works_slick_list swiper-slide">
                            <a href="portfolio.html"><img src="{{ Module::asset('front:img/others/slide-img1.jpg') }}" alt="" /></a>
                            <div class="work_slick_text">
                                <h2 class="title">
                                    <a class="title-link" href="portfolio.html">Lawa Lawyers Firm</a>
                                </h2>

                            </div>
                        </div>
                        <div class="works_slick_list swiper-slide">
                            <a href="portfolio.html"><img src="{{ Module::asset('front:img/others/slide-img2.jpg') }}" alt="" /></a>
                            <div class="work_slick_text">
                                <h2 class="title">
                                    <a class="title-link" href="portfolio.html">Lawa Lawyers Firm</a>
                                </h2>

                            </div>
                        </div>
                        <div class="works_slick_list swiper-slide">
                            <a href="portfolio.html"><img src="{{ Module::asset('front:img/others/slide-img3.jpg') }}" alt="" /></a>
                            <div class="work_slick_text">
                                <h2 class="title">
                                    <a class="title-link" href="portfolio.html">Lawa Lawyers Firm</a>
                                </h2>

                            </div>
                        </div>
                        <div class="works_slick_list swiper-slide">
                            <a href="portfolio.html"><img src="{{ Module::asset('front:img/others/slide-img1.jpg') }}" alt="" /></a>
                            <div class="work_slick_text">
                                <h2 class="title">
                                    <a class="title-link" href="portfolio.html">Lawa Lawyers Firm</a>
                                </h2>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="tab-pane fade" id="video" role="tabpanel">
                <div class="works_slide_wrapper text-center swiper-container">
                    <div class="work_slider_inner swiper-wrapper">
                        <div class="works_slick_list  swiper-slide">
                            <a href="portfolio.html"><img src="{{ Module::asset('front:img/others/slide-img1.jpg') }}" alt="" /></a>
                            <div class="work_slick_text">
                                <h2 class="title">
                                    <a class="title-link" href="portfolio.html">Lawa Lawyers Firm</a>
                                </h2>

                            </div>
                        </div>
                        <div class="works_slick_list swiper-slide">
                            <a href="portfolio.html"><img src="{{ Module::asset('front:img/others/slide-img2.jpg') }}" alt="" /></a>
                            <div class="work_slick_text">
                                <h2 class="title">
                                    <a class="title-link" href="portfolio.html">Lawa Lawyers Firm</a>
                                </h2>

                            </div>
                        </div>
                        <div class="works_slick_list swiper-slide">
                            <a href="portfolio.html"><img src="{{ Module::asset('front:img/others/slide-img3.jpg') }}" alt="" /></a>
                            <div class="work_slick_text">
                                <h2 class="title">
                                    <a class="title-link" href="portfolio.html">Lawa Lawyers Firm</a>
                                </h2>

                            </div>
                        </div>
                        <div class="works_slick_list swiper-slide">
                            <a href="portfolio.html"><img src="{{ Module::asset('front:img/others/slide-img1.jpg') }}" alt="" /></a>
                            <div class="work_slick_text">
                                <h2 class="title">
                                    <a class="title-link" href="portfolio.html">Lawa Lawyers Firm</a>
                                </h2>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="view_all_works text-center">
        <a href="#">View All Works</a>
    </div>
</section>
<!-- product section end -->

<!--testimonial section start-->
<section class="testimonial_section">
    <div class="container">
        <div class="row">
            <div class="col-lg-5 col-md-6">
                <div class="testimonial_inner">
                    <div class="section_title text-start mb-80">
                        <h2 class="wow fadeInUp" data-wow-delay="0.1s" data-wow-duration="1.1s">
                            More 1,200 <br />
                            <span>Happy Customers</span>
                        </h2>
                    </div>
                    <div class="testimonial_slick swiper-container">
                        <div class="swiper-wrapper">
                            <div class="testimonial_slick_list swiper-slide">
                                <div class="testimonial_content text-start">
                                    <h3 class="wow fadeInUp" data-wow-delay="0.2s" data-wow-duration="1.2s">
                                        This is Photoshop's version of Lorem Ipsum !
                                    </h3>
                                    <p class="wow fadeInUp" data-wow-delay="0.3s" data-wow-duration="1.3s">
                                        Proin gravida nibh vel velit auctor aliquet. Aenean
                                        sollicitudin, lorem quis bibendum auctor, nisi elit
                                        consequat ipsum, nec sagittis sem nibh id elit. Duis sed
                                        odio sit amet nibh vulputate cursus a sit amet mauris.
                                        Morbi accumsan ipsum velit. Nam nec tellus a odio
                                        tincidunt auctor a ornare odio. Sed non mauris vitae
                                        erat consequat auctor eu in elit. Class aptent taciti
                                        sociosqu ad litora torquent per conubia nostra, per
                                        inceptos himenaeos
                                    </p>
                                    <div class="testimonial_footer wow fadeInUp" data-wow-delay="0.4s"
                                         data-wow-duration="1.4s">
                                        <p><a href="#">Aslam Hasib </a> - Founder’s HasTech</p>
                                    </div>
                                </div>
                            </div>
                            <div class="testimonial_slick_list  swiper-slide">
                                <div class="testimonial_content text-start">
                                    <h3 class="wow fadeInUp" data-wow-delay="0.2s" data-wow-duration="1.2s">
                                        This is Photoshop's version of Lorem Ipsum !
                                    </h3>
                                    <p class="wow fadeInUp" data-wow-delay="0.3s" data-wow-duration="1.3s">
                                        Proin gravida nibh vel velit auctor aliquet. Aenean
                                        sollicitudin, lorem quis bibendum auctor, nisi elit
                                        consequat ipsum, nec sagittis sem nibh id elit. Duis sed
                                        odio sit amet nibh vulputate cursus a sit amet mauris.
                                        Morbi accumsan ipsum velit. Nam nec tellus a odio
                                        tincidunt auctor a ornare odio. Sed non mauris vitae
                                        erat consequat auctor eu in elit. Class aptent taciti
                                        sociosqu ad litora torquent per conubia nostra, per
                                        inceptos himenaeos
                                    </p>
                                    <div class="testimonial_footer wow fadeInUp" data-wow-delay="0.4s"
                                         data-wow-duration="1.4s">
                                        <p><a href="#">Aslam Hasib </a> - Founder’s HasTech</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Add Arrows -->
                        <div class="swiper-buttons">
                            <div class="swiper-button-next"><i aria-hidden="true" class="ei ei-arrow_right"></i>
                            </div>
                            <div class="swiper-button-prev"><i aria-hidden="true" class="ei ei-arrow_left"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="testimonial_position_img d-none d-md-block">
        <img class="w-100 h-100" src="{{ Module::asset('front:img/others/testimonial-position.png') }}" alt="" />
    </div>
</section>
<!--testimonial section end-->

<!-- blog section start -->
<section class="blog_section">
    <div class="container">
        <div class="section_title text-center mb-66">
            <h2 class="wow fadeInUp" data-wow-delay="0.1s" data-wow-duration="1.1s">
                Latest <span>Articles</span>
            </h2>
        </div>
        <div class="blog_container swiper-container">
            <div class="swiper-wrapper blog_slick slick_slider_activation">
                <div class="swiper-slide">
                    <article class="single_blog wow fadeInUp" data-wow-delay="0.1s" data-wow-duration="1.1s">
                        <figure>
                            <div class="blog_thumb">
                                <a href="blog-details.html"><img src="{{ Module::asset('front:img/blog/blog1.jpg') }}" alt="" /></a>
                            </div>
                            <figcaption class="blog_content">
                                <div class="blog_meta">
                                    <span>March, 24th, 2025</span>
                                </div>
                                <h3>
                                    <a href="blog-details.html">Put title for single blog with image format here</a>
                                </h3>
                                <a href="blog-details.html">Continue <i class="ei ei-arrow_right"></i></a>
                            </figcaption>
                        </figure>
                    </article>
                </div>
                <div class="swiper-slide">
                    <article class="single_blog wow fadeInUp" data-wow-delay="0.2s" data-wow-duration="1.2s">
                        <figure>
                            <div class="blog_thumb">
                                <a href="blog-details.html"><img src="{{ Module::asset('front:img/blog/blog2.jpg') }}" alt="" /></a>
                            </div>
                            <figcaption class="blog_content">
                                <div class="blog_meta">
                                    <span>March, 24th, 2025</span>
                                </div>
                                <h3>
                                    <a href="blog-details.html">Lorem ipsum dolor sit amet image there are elit.</a>
                                </h3>
                                <a href="blog-details.html">Continue <i class="ei ei-arrow_right"></i></a>
                            </figcaption>
                        </figure>
                    </article>
                </div>
                <div class="swiper-slide">
                    <article class="single_blog wow fadeInUp" data-wow-delay="0.3s" data-wow-duration="1.3s">
                        <figure>
                            <div class="blog_thumb">
                                <a href="blog-details.html"><img src="{{ Module::asset('front:img/blog/blog6.jpg') }}" alt="" /></a>
                            </div>
                            <figcaption class="blog_content">
                                <div class="blog_meta">
                                    <span>March, 24th, 2025</span>
                                </div>
                                <h3>
                                    <a href="blog-details.html">
                                        Sit amet here elit. Debitis fugiat fuga mollitia
                                        itaque.</a>
                                </h3>
                                <a href="blog-details.html">Continue <i class="ei ei-arrow_right"></i></a>
                            </figcaption>
                        </figure>
                    </article>
                </div>
                <div class="swiper-slide">
                    <article class="single_blog wow fadeInUp" data-wow-delay="0.4s" data-wow-duration="1.4s">
                        <figure>
                            <div class="blog_thumb">
                                <a href="blog-details.html"><img src="{{ Module::asset('front:img/blog/blog4.jpg') }}" alt="" /></a>
                            </div>
                            <figcaption class="blog_content">
                                <div class="blog_meta">
                                    <span>March, 24th, 2025</span>
                                </div>
                                <h3>
                                    <a href="blog-details.html">Put title for single blog with image format here</a>
                                </h3>
                                <a href="blog-details.html">Continue <i class="ei ei-arrow_right"></i></a>
                            </figcaption>
                        </figure>
                    </article>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- blog section end -->

<!--footer area start-->
<footer class="footer_widgets">
    <div class="container">
        <div class="section_title text-center position-relative mb-66">
            <h2>Drop Us <span>A Line</span></h2>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="footer_inner position-relative">
                    <div class="footer_form">

                        <!-- Contact Form -->
                        <div class="contact-form">

                            <!--Contact Form-->
                            <form id="contact-form" action="https://htmlmail.hasthemes.com/nazmul/mail.php"
                                  method="post">
                                <div class="row">
                                    <div class="col-lg-4 col-md-6 col-sm-12 form_input_list">
                                        <input name="name" placeholder="Enter your name..." type="text" />
                                    </div>
                                    <div class="col-lg-4 col-md-6 col-sm-12 form_input_list">
                                        <input name="email" placeholder="Enter your Mail.." type="email" />
                                    </div>
                                    <div class="col-lg-4 col-md-6 col-sm-12 form_input_list">
                                        <input name="subject" placeholder="Subject (Optional)" type="text" />
                                    </div>
                                    <div class="col-lg-12 col-md-12 col-sm-12 form_input_list">
                                        <textarea name="message" placeholder="Here goes your message"></textarea>
                                    </div>
                                    <div class="col-lg-12 col-md-12 col-sm-12 text-center">
                                        <button class="  btn btn-link" type="submit" name="submit-form"><span
                                                class="txt">Send Message</span></button>
                                    </div>
                                </div>
                            </form>
                            <p class="form-messege"></p>
                            <!--End Contact Form -->
                        </div>
                    </div>
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
                                    ©2021 Asore. made with <i class="ion-heart"></i> by
                                    <a href="https://hasthemes.com">HasThemes</a>
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
