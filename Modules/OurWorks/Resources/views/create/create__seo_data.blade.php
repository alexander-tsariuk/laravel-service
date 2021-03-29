<div class="card">
    <div class="card-header">
        <h3 class="card-title">Мета-теги страницы</h3>
    </div>
    <div class="card-body">
        <ul class="nav nav-tabs" id="custom-tabs-3-tab" role="tablist">
            @if(isset($languages) && !empty($languages))
                @foreach($languages as $language)
                    <li class="nav-item">
                        <a
                            class="nav-link {{ $loop->first ? 'active' : ''}}"
                            id="meta_tags-{{$language->id}}-tab"
                            data-toggle="pill"
                            href="#meta_tags-{{$language->id}}"
                            role="tab"
                            aria-controls="meta_tags-{{$language->id}}"
                            aria-selected="true">{{ $language->name }}</a>
                    </li>
                @endforeach
            @endif
        </ul>
        <div class="tab-content" id="meta_tags-{{$language->id}}-tabContent">
            @if(isset($languages) && !empty($languages))
                @foreach($languages as $language)
                    <div class="tab-pane fade {{ $loop->first ? 'active show' : ''}} pt-5" id="meta_tags-{{$language->id}}" role="tabpanel" aria-labelledby="meta_tags-{{$language->id}}-tab">
                        <div class="form-group">
                            <label for="name">Мета заголовок</label>
                            <input
                                type="text"
                                class="form-control form-control-border {{ $errors->has('meta_title') ? 'is-invalid' : '' }}"
                                name="translation[{{$language->id}}][meta_title]"
                            />
                            @if($errors->has('meta_title'))
                                <span class="text-danger">{{ $errors->first('meta_title') }}</span>
                            @endif
                        </div>
                        <div class="form-group">
                            <label for="name">Мета H1</label>
                            <input
                                type="text"
                                class="form-control form-control-border {{ $errors->has('meta_h1') ? 'is-invalid' : '' }}"
                                name="translation[{{$language->id}}][meta_h1]"
                            />
                            @if($errors->has('meta_h1'))
                                <span class="text-danger">{{ $errors->first('meta_h1') }}</span>
                            @endif
                        </div>
                        <div class="form-group">
                            <label for="name">Мета ключевые слова</label>
                            <input
                                type="text"
                                class="form-control form-control-border {{ $errors->has('meta_keywords') ? 'is-invalid' : '' }}"
                                name="translation[{{$language->id}}][meta_keywords]"
                            />
                            @if($errors->has('meta_keywords'))
                                <span class="text-danger">{{ $errors->first('meta_keywords') }}</span>
                            @endif
                        </div>
                        <div class="form-group">
                            <label for="name">Мета описание</label>
                            <input
                                type="text"
                                class="form-control form-control-border {{ $errors->has('meta_description') ? 'is-invalid' : '' }}"
                                name="translation[{{$language->id}}][meta_description]"
                                value="{{ $item->preparedTranslations[$language->id]->meta_description ?? null }}"
                            />
                            @if($errors->has('meta_description'))
                                <span class="text-danger">{{ $errors->first('meta_description') }}</span>
                            @endif
                        </div>
                        <div class="form-group">
                            <label for="name">Установить 404 ответ сервера</label>
                            <select class="form-control form-control-border {{ $errors->has('set_404') ? 'is-invalid' : '' }}"
                                    name="translation[{{$language->id}}][set_404]">
                                <option value="0">Нет</option>
                                <option value="1">Да</option>
                            </select>

                            @if($errors->has('set_404'))
                                <span class="text-danger">{{ $errors->first('set_404') }}</span>
                            @endif
                        </div>
                        <div class="form-group">
                            <label for="name">Установить NOINDEX</label>
                            <select class="form-control form-control-border {{ $errors->has('set_noindex') ? 'is-invalid' : '' }}"
                                    name="translation[{{$language->id}}][set_noindex]">
                                <option value="0">Нет</option>
                                <option value="1">Да</option>
                            </select>

                            @if($errors->has('set_noindex'))
                                <span class="text-danger">{{ $errors->first('set_noindex') }}</span>
                            @endif
                        </div>
                        <div class="form-group">
                            <label for="name">Установить NOFOLLOW</label>
                            <select class="form-control form-control-border {{ $errors->has('set_nofollow') ? 'is-invalid' : '' }}"
                                    name="translation[{{$language->id}}][set_nofollow]">
                                <option value="0">Нет</option>
                                <option value="1">Да</option>
                            </select>

                            @if($errors->has('set_nofollow'))
                                <span class="text-danger">{{ $errors->first('set_nofollow') }}</span>
                            @endif
                        </div>
                    </div>
                @endforeach
            @endif
        </div>
    </div>

    <div class="card-footer">
        <button type="submit" class="btn btn-info">Сохранить</button>
        <a href="{{ route('dashboard.ourservice.index') }}" class="btn btn-default float-right">Отмена</a>
    </div>
</div>
