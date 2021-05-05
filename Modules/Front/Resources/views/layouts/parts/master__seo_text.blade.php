@if(isset($service->translation->seo_text) && !empty($service->translation->seo_text))
    <section class="team_members_section mt-5">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    {!! $service->translation->seo_text !!}
                </div>
            </div>
        </div>
    </section>
@endif
