@extends('dashboard::layouts.master')

@section('content')
    <div class="row">
        <div class="col-12">
            <form id="editItem" action="{{ route('dashboard.page.update', ['itemId' => $item->id]) }}" method="POST">
                @csrf
                @method('PUT')
                @include('page::edit.edit__main_data')
                @include('page::edit.edit__content')
                @include('page::edit.edit__meta_tags')
            </form>
        </div>
    </div>

@endsection
