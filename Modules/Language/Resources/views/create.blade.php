@extends('dashboard::layouts.master')

@section('content')
    <div class="row">
        <div class="col-12">
            <form id="editItem" action="{{ route('dashboard.language.store') }}" method="POST">
                @csrf
                <div class="card">
                    <div class="card-body">
                        <div class="form-group">
                            <label for="name">Название языковой версии</label>
                            <input
                                type="text"
                                class="form-control form-control-border {{ $errors->has('name1') ? 'is-invalid' : '' }}"
                                name="name"
                                placeholder="English"
                                value="{{ old('name') }}"
                            />
                            @if($errors->has('name'))
                                <span class="text-danger">{{ $errors->first('name') }}</span>
                            @endif
                        </div>
                        <div class="form-group">
                            <label for="prefix">Префикс <br><code>Только латинские символы</code></label>
                            <input
                                type="text"
                                class="form-control form-control-border border-width-2 {{ $errors->has('prefix') ? 'is-invalid' : '' }}"
                                name="prefix"
                                placeholder="en"
                                value="{{ old('prefix') }}"
                            />
                            @if($errors->has('prefix'))
                                <span class="text-danger">{{ $errors->first('prefix') }}</span>
                            @endif
                        </div>
                        <div class="form-group">
                            <label for="status">Статус</label>
                            <select class="custom-select form-control-border {{ $errors->has('status') ? 'is-invalid' : '' }}" name="status">
                                <option value="0">Неактивен</option>
                                <option value="1">Активен</option>
                            </select>
                            @if($errors->has('status'))
                                <span class="text-danger">{{ $errors->first('status') }}</span>
                            @endif
                        </div>
                        <div class="form-group">
                            <label for="default">По-умолчанию <br><code>При установке этого параметра "Да", языковая версия станет по-умолчанию.</code></label>
                            <select class="custom-select form-control-border {{ $errors->has('default') ? 'is-invalid' : '' }}" name="default">
                                <option value="0">Нет</option>
                                <option value="1">Да</option>
                            </select>
                            @if($errors->has('default'))
                                <span class="text-danger">{{ $errors->first('default') }}</span>
                            @endif
                        </div>
                    </div>
                    <!-- /.card-body -->
                    <div class="card-footer">
                        <button type="submit" class="btn btn-info">Сохранить</button>
                        <a href="{{ route('dashboard.language.index') }}" class="btn btn-default float-right">Отмена</a>
                    </div>
                </div>
            </form>
        </div>
    </div>

@endsection
