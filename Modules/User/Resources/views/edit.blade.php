@extends('dashboard::layouts.master')

@section('content')
    <div class="row">
        <div class="col-12">
            <form id="editItem" action="{{ route('dashboard.user.update', ['itemId' => $item->id]) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="card">
                    <div class="card-body">
                        <div class="form-group">
                            <label for="name">Имя</label>
                            <input type="text" class="form-control form-control-border {{ $errors->has('name') ? 'is-invalid' : '' }}" name="name" required value="{{$item->name}}">
                            @if($errors->has('name'))
                                <span class="text-danger">{{ $errors->first('name') }}</span>
                            @endif
                        </div>
                        <div class="form-group">
                            <label for="surname">Фамилия</label>
                            <input type="text" class="form-control form-control-border {{ $errors->has('name') ? 'is-invalid' : '' }}" name="surname" required value="{{$item->surname}}">
                            @if($errors->has('surname'))
                                <span class="text-danger">{{ $errors->first('surname') }}</span>
                            @endif
                        </div>
                        <div class="form-group">
                            <label for="email">E-mail</label>
                            <input type="email" class="form-control form-control-border {{ $errors->has('name') ? 'is-invalid' : '' }}" name="email" required value="{{$item->email}}">
                            @if($errors->has('email'))
                                <span class="text-danger">{{ $errors->first('email') }}</span>
                            @endif
                        </div>
                        <div class="form-group">
                            <label for="phone">Телефон</label>
                            <input type="text" class="form-control form-control-border {{ $errors->has('name') ? 'is-invalid' : '' }}" name="phone" required value="{{$item->phone}}">
                            @if($errors->has('phone'))
                                <span class="text-danger">{{ $errors->first('phone') }}</span>
                            @endif
                        </div>
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
                    </div>
                    <!-- /.card -->
                    <div class="card-footer">
                        <button type="submit" class="btn btn-info">Сохранить</button>
                        <a href="{{ route('dashboard.user.index') }}" class="btn btn-default float-right">Отмена</a>
                    </div>
                </div>
            </form>
        </div>
    </div>

@endsection
