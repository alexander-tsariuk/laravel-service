<div class="card card-outline card-tabs">
    <div class="card-header">
        <h3 class="card-title">Контент страницы</h3>
    </div>
    <div class="card-body">
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
        <div class="tab-content pt-5" id="custom-tabs-two-tabContent">
            @if(isset($languages) && !empty($languages))
                @foreach($languages as $language)
                    <div class="tab-pane fade {{ $loop->first ? 'active show' : ''}}" id="custom-tabs-{{$language->id}}-home" role="tabpanel" aria-labelledby="custom-tabs-{{$language->id}}-home-tab">
                        <div class="form-group">
                            <label for="name">Название</label>
                            <input
                                type="text"
                                class="form-control form-control-border {{ $errors->has('name') ? 'is-invalid' : '' }}"
                                name="translation[{{$language->id}}][name]"
                                value="{{ old('translation.'.$language->id.'.name') ?? $item->preparedTranslations[$language->id]->name ?? null }}"
                                required
                            />
                            @if($errors->has('name'))
                                <span class="text-danger">{{ $errors->first('name') }}</span>
                            @endif
                        </div>
                        <div class="form-group">
                            <label for="short_description">Краткое описание</label>
                            <input
                                type="text"
                                class="form-control form-control-border {{ $errors->has('short_description') ? 'is-invalid' : '' }}"
                                name="translation[{{$language->id}}][short_description]"
                                value="{{ old('translation.'.$language->id.'.short_description') ?? $item->preparedTranslations[$language->id]->short_description ?? null }}"
                            />
                            @if($errors->has('short_description'))
                                <span class="text-danger">{{ $errors->first('short_description') }}</span>
                            @endif
                        </div>
                        <div class="form-group">
                            <label for="name">Описание</label>
                            <textarea
                                rows="2"
                                cols="2"
                                class="summernote form-control form-control-border {{ $errors->has('content') ? 'is-invalid' : '' }}"
                                name="translation[{{$language->id}}][content]"
                            >{{ old('translation.'.$language->id.'.content') ?? $item->preparedTranslations[$language->id]->content ?? null }}</textarea>
                            @if($errors->has('content'))
                                <span class="text-danger">{{ $errors->first('content') }}</span>
                            @endif
                        </div>
                    </div>
                @endforeach
            @endif
        </div>
    </div>
    <!-- /.card -->
</div>
