@extends('dashboard::layouts.master')

@section('content')
    <div class="row">
        <div class="col-12">
            <form id="editItem" action="{{ route('dashboard.project.store') }}" method="POST">
                @csrf
                @include('project::create.edit__main_data')
                @include('project::create.edit__content')
                @include('project::create.edit__meta_tags')
            </form>
        </div>
    </div>

@endsection
