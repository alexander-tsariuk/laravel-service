@extends('dashboard::layouts.master')

@section('content')
{{--    @if($errors->any())--}}
{{--        {{ dd($errors) }}--}}
{{--    @endif--}}

    <div class="row">
        <div class="col-12">
            <form id="editItem" action="{{ route('dashboard.ourservice.store') }}" method="POST">
                @csrf
                @include('ourworks::create.create__main_data')
                @include('ourworks::create.create__content_data')
                @include('ourworks::create.create__seo_data')
            </form>
        </div>
    </div>

@endsection
