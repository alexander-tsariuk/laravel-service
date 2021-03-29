@extends('dashboard::layouts.master')

@section('content')
    <div class="row">
        <div class="col-12">
            <form id="editItem" action="{{ route('dashboard.ourservice.update', ['itemId' => $item->id]) }}" method="POST">
                @csrf
                @method('PUT')

                @include('ourworks::edit.edit__main_data')
                @include('ourworks::edit.edit__content_data')
                @include('ourworks::edit.edit__seo_data')

            </form>
        </div>
    </div>

@endsection
