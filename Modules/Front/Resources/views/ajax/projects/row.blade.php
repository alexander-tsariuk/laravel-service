<div class="col-lg-4 col-md-6 col-sm-6 gird_item entertaiment life technology">
    <figure class="portfolio_thumb wow fadeInUp" data-wow-delay="0.1s" data-wow-duration="1.1s" style="visibility: visible; animation-duration: 1.1s; animation-delay: 0.1s; animation-name: fadeInUp;">
        <a href="{{config()->get('app.defaultLocale') != config()->get('app.locale') ? "/".config()->get('app.locale') : null}}{{ route('front.render.page', ['prefix' => $project->prefix], false) }}">
            <img src="/storage{{ $project->image }}" alt="{{ $project->translation->name }}">
        </a>
        <div class="portfolio_text">
            <h3>{{ $project->translation->name }}</h3>
        </div>
    </figure>
</div>
