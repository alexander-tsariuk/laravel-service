@extends('dashboard::layouts.master')

@section('content')
    <div class="row mb-3">
        <div class="col-2">
            <a href="{{ route('dashboard.slider.create') }}" class="btn btn-block btn-primary">Добавить</a>
        </div>
    </div>

    <div class="row">

        <div class="col-12">
            <div class="card">

                <!-- /.card-header -->
                <div class="card-body p-0">
                    <table class="table text-center">
                        <thead>
                        <tr>
                            <th style="width: 10px">#</th>
                            <th>Название</th>
                            <th>Статус</th>
                            <th></th>
                        </tr>
                        </thead>
                        <tbody>
                        @if(isset($items) && !empty($items))
                            @foreach($items as $item)
                                <tr>
                                    <td>{{ $item->id }}</td>
                                    <td>{{ $item->translation->heading_text }}</td>
                                    <td>{!! tableStatus($item->status) !!}</td>
                                    <td>{!! tableActions($item->id, 'slider') !!}</td>
                                </tr>
                            @endforeach
                        @else
                            <tr>
                                <td colspan="5" class="text-danger text-center">Ни одной записи не было найдено!</td>
                            </tr>
                        @endif
                        </tbody>
                    </table>
                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                    <div class="card-tools">
                        {{ $items->links('dashboard::pagination.master__pagination') }}
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('footerScripts')


@endsection
