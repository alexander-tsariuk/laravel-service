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
                            @if($errors->has('name'))
                                <span class="text-danger">{{ $errors->first('name') }}</span>
                            @endif
                        </div>
                    </div>
                @endforeach
            @endif
        </div>
    </div>
    <!-- /.card -->
</div>
