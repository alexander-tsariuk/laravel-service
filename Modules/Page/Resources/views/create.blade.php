@extends('dashboard::layouts.master')

@section('content')
    <div class="row">
        <div class="col-12">
            <form id="editItem" action="{{ route('dashboard.page.store') }}" method="POST">
                @csrf
                @include('page::create.edit__main_data')
                @include('page::create.edit__content')
                @include('page::create.edit__meta_tags')
            </form>
        </div>
    </div>

@endsection
