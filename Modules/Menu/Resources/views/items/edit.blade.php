@extends('dashboard::layouts.master')

@section('content')
    <div class="row">
        <div class="col-12">
            <form id="editItem" action="{{ route('dashboard.menu.items.update', ['itemId' => $itemId, 'elementId' => $item->id]) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Основная информация</h3>
                    </div>
                    <div class="card-body">
                        <div class="form-group">
                            <label for="menuId">Меню</label>
                            <select class="custom-select form-control-border {{ $errors->has('menuId') ? 'is-invalid' : '' }}" name="menuId" required>
                                <option value="0">Не выбрано</option>
                                @if(isset($menus) && !empty($menus))
                                    @foreach($menus as $menu)
                                        <option value="{{ $menu->id }}" {{ $menu->id == $item->menuId ? 'selected' : '' }}>{{ $menu->name }}</option>
                                    @endforeach
                                @endif
                            </select>

                            @if($errors->has('menuId'))
                                <span class="text-danger">{{ $errors->first('menuId') }}</span>
                            @endif
                        </div>

                        <div class="form-group">
                            <label for="parentId">Родительский элемент</label>
                            <select class="custom-select form-control-border {{ $errors->has('parentId') ? 'is-invalid' : '' }}" name="parentId" required>
                                <option value="0">Не выбрано</option>
                                @if(isset($menuItems) && !empty($menuItems))
                                    @foreach($menuItems as $menuItem)
                                        <option value="{{ $menuItem->id }}" {{ $menuItem->parentId == $menuItem->id ? 'selected' : '' }}>{{ $menuItem->translation->label }}</option>
                                    @endforeach
                                @endif
                            </select>

                            @if($errors->has('parentId'))
                                <span class="text-danger">{{ $errors->first('parentId') }}</span>
                            @endif
                        </div>

                        <div class="form-group">
                            <label for="url">URL</label>
                            <input type="text" class="custom-select form-control-border {{ $errors->has('url') ? 'is-invalid' : '' }}" name="url" required value="{{ $item->url }}">

                            @if($errors->has('url'))
                                <span class="text-danger">{{ $errors->first('url') }}</span>
                            @endif
                        </div>


                        <div class="form-group">
                            <label for="status">Статус</label>
                            <select class="custom-select form-control-border {{ $errors->has('status') ? 'is-invalid' : '' }}" name="status" required>
                                <option value="0">Неактивен</option>
                                <option value="1" {{ isset($item->status) && $item->status == 1 ? 'selected' : '' }}>Активен</option>
                            </select>
                            @if($errors->has('status'))
                                <span class="text-danger">{{ $errors->first('status') }}</span>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Переводы</h3>
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
                                            <label for="name">Название ссылки</label>
                                            <input
                                                type="text"
                                                class="form-control form-control-border {{ $errors->has('label') ? 'is-invalid' : '' }}"
                                                name="translation[{{$language->id}}][label]"
                                                required
                                                value="{{ $item->preparedTranslations[$language->id]->label }}"
                                            />
                                            @if($errors->has('label'))
                                                <span class="text-danger">{{ $errors->first('label') }}</span>
                                            @endif
                                        </div>
                                    </div>
                                @endforeach
                            @endif
                        </div>
                    </div>

                    <div class="card-footer">
                        <button type="submit" class="btn btn-info">Сохранить</button>
                        <a href="{{ route('dashboard.menu.items.index', ['itemId' => $itemId]) }}" class="btn btn-default float-right">Отмена</a>
                    </div>
                </div>

            </form>
        </div>
    </div>

@endsection
