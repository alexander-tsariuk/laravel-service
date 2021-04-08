@extends('dashboard::layouts.master')

@section('content')
    <div class="row">
        <div class="col-12">
            <form id="editItem" action="{{ route('dashboard.menu.update', ['itemId' => $item->id]) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Основная информация</h3>
                    </div>
                    <div class="card-body">
                        <div class="form-group">
                            <label for="status">Статус</label>
                            <select class="custom-select form-control-border {{ $errors->has('status') ? 'is-invalid' : '' }}" name="status" required>
                                <option value="0" {{ !$item->status ? 'selected' : '' }}>Неактивен</option>
                                <option value="1" {{ !empty($item->status) && $item->status == 1 ? 'selected' : '' }}>Активен</option>
                            </select>
                            @if($errors->has('status'))
                                <span class="text-danger">{{ $errors->first('status') }}</span>
                            @endif
                        </div>
                        <div class="form-group">
                            <label for="code">Код меню
                                <br><code>Только латинские символы</code>
                            </label>
                            <input type="text" class="custom-select form-control-border {{ $errors->has('code') ? 'is-invalid' : '' }}" name="code" required value="{{ $item->code }}">

                            @if($errors->has('code'))
                                <span class="text-danger">{{ $errors->first('code') }}</span>
                            @endif
                        </div>
                        <div class="form-group">
                            <label for="name">
                                Название меню
                                <br><code>Не видно пользователю</code>
                            </label>
                            <input type="text" class="custom-select form-control-border {{ $errors->has('name') ? 'is-invalid' : '' }}" name="name" required value="{{ $item->name }}">

                            @if($errors->has('name'))
                                <span class="text-danger">{{ $errors->first('name') }}</span>
                            @endif
                        </div>
                    </div>
                    <div class="card-footer">
                        <button type="submit" class="btn btn-info">Сохранить</button>
                        <a href="{{ route('dashboard.menu.index') }}" class="btn btn-default float-right">Отмена</a>
                    </div>
                </div>

            </form>
        </div>
    </div>

@endsection
