@extends('dashboard::layouts.master')

@section('content')
    <div class="row">
        <div class="col-12">
            <form id="editItem" action="{{ route('dashboard.ourservice.store') }}" method="POST">
                @csrf
                <div class="card">
                    <div class="card-body">
                        <div class="form-group">
                            <label for="status">Статус</label>
                            <select class="custom-select form-control-border {{ $errors->has('status') ? 'is-invalid' : '' }}" name="status" required>
                                <option value="0">Неактивен</option>
                                <option value="1">Активен</option>
                            </select>
                            @if($errors->has('status'))
                                <span class="text-danger">{{ $errors->first('status') }}</span>
                            @endif
                        </div>
                        <div class="form-group">
                            <label for="prefix">Алиас</label>
                            <input type="text" class="custom-select form-control-border {{ $errors->has('prefix') ? 'is-invalid' : '' }}" name="prefix" required value="{{ old('prefix') }}">
                            @if($errors->has('prefix'))
                                <span class="text-danger">{{ $errors->first('prefix') }}</span>
                            @endif
                        </div>
                    </div>
                </div>
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
                                            <label for="translation[{{$language->id}}][name]">Название работы</label>
                                            <input
                                                type="text"
                                                class="form-control form-control-border {{ $errors->has('name') ? 'is-invalid' : '' }}"
                                                name="translation[{{$language->id}}][name]"
                                                value=""
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
                    <div class="card-footer">
                        <button type="submit" class="btn btn-info">Сохранить</button>
                        <a href="{{ route('dashboard.ourservice.index') }}" class="btn btn-default float-right">Отмена</a>
                    </div>
                </div>
            </form>
        </div>
    </div>

@endsection
