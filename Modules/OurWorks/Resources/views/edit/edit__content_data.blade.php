<div class="card card-outline card-tabs">
    <div class="card-header p-0 pt-1 border-bottom-0">
        <ul class="nav nav-tabs" id="custom-tabs-two-tab" role="tablist">
            @if(isset($languages) && !empty($languages))
                @foreach($languages as $language)
                    <li class="nav-item">
                        <a
                            class="nav-link {{ $loop->first ? 'active' : ''}}"
                            id="custom-tabs-{{$language->id}}-home-tab"
                            data-toggle="pill"
                            href="#custom-tabs-{{$language->id}}-home"
                            role="tab"
                            aria-controls="custom-tabs-{{$language->id}}-home"
                            aria-selected="true">{{ $language->name }}</a>
                    </li>
                @endforeach
            @endif
        </ul>
    </div>
    <div class="card-body">
        <div class="tab-content" id="custom-tabs-two-tabContent">
            @if(isset($languages) && !empty($languages))
                @foreach($languages as $language)
                    <div class="tab-pane fade {{ $loop->first ? 'active show' : ''}}" id="custom-tabs-{{$language->id}}-home" role="tabpanel" aria-labelledby="custom-tabs-{{$language->id}}-home-tab">
                        <div class="form-group">
                            <label for="name">Название работы</label>
                            <input
                                type="text"
                                class="form-control form-control-border {{ $errors->has('name') ? 'is-invalid' : '' }}"
                                name="translation[{{$language->id}}][name]"
                                value="{{ $item->preparedTranslations[$language->id]->name ?? null }}"
                                required
                            />
                            @if($errors->has('translation.'.$language->id.'.name'))
                                <span class="text-danger">{{ $errors->first('translation.'.$language->id.'.name') }}</span>
                            @endif
                        </div>

                        <div class="form-group">
                            <label for="translation[{{$language->id}}][short_description]">Краткое описание</label>
                            <input
                                type="text"
                                class="form-control form-control-border {{ $errors->has('short_description') ? 'is-invalid' : '' }}"
                                name="translation[{{$language->id}}][short_description]"
                                value="{{ $item->preparedTranslations[$language->id]->short_description ?? null }}"
                            />
                            @if($errors->has('translation.'.$language->id.'.short_description'))
                                <span class="text-danger">{{ $errors->first('translation.'.$language->id.'.short_description') }}</span>
                            @endif
                        </div>


                        <div class="form-group">
                            <label for="translation[{{$language->id}}][seo_text]">SEO текст</label>
                            <textarea
                                class="summernote form-control form-control-border {{ $errors->has('seo_text') ? 'is-invalid' : '' }}"
                                name="translation[{{$language->id}}][seo_text]"
                            >{{ $item->preparedTranslations[$language->id]->seo_text ?? null }}</textarea>
                            @if($errors->has('translation.'.$language->id.'.seo_text'))
                                <span class="text-danger">{{ $errors->first('translation.'.$language->id.'.seo_text') }}</span>
                            @endif
                        </div>
                    </div>
                @endforeach
            @endif
        </div>
    </div>
    <!-- /.card -->
</div>
