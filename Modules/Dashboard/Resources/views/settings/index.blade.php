@extends('dashboard::layouts.master')

@section('content')
    <div class="row">
        <div class="col-12">
            <form id="editItem" action="{{ route('dashboard.settings.update') }}" method="POST">
                @method('PUT')
                @csrf
                <div class="card card-primary card-tabs">
                    <div class="card-header p-0 pt-1">
                        <ul class="nav nav-tabs" id="custom-tabs-one-tab" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" id="custom-tabs-one-home-tab" data-toggle="pill" href="#custom-tabs-one-home" role="tab" aria-controls="custom-tabs-one-home" aria-selected="false">Основные</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="custom-tabs-one-profile-tab" data-toggle="pill" href="#custom-tabs-one-main_page" role="tab" aria-controls="custom-tabs-one-main_page" aria-selected="true">Главная страница</a>
                            </li>
                        </ul>
                    </div>
                    <div class="card-body">
                        <div class="tab-content" id="custom-tabs-one-tabContent">
                            <div class="tab-pane fade active show" id="custom-tabs-one-home" role="tabpanel" aria-labelledby="custom-tabs-one-home-tab">
                                @include('dashboard::settings.parts.settings__general-fields')
                            </div>
                            <div class="tab-pane fade" id="custom-tabs-one-main_page" role="tabpanel" aria-labelledby="custom-tabs-one-main_page-tab">
                                @include('dashboard::settings.parts.settings__general-main_page')
                            </div>
                        </div>
                    </div>
                    <!-- /.card -->
                    <div class="card-footer">
                        <button type="submit" class="btn btn-info">Сохранить</button>
                        <a href="{{ route('dashboard.settings.index') }}" class="btn btn-default float-right">Отмена</a>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
