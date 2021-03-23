@extends('dashboard::layouts.master')

@section('content')
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
                                <th>По-умолчанию</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @if(isset($items) && !empty($items))
                                @foreach($items as $item)
                                    <tr>
                                        <td>{{ $item->id }}</td>
                                        <td>{{ $item->name }}</td>
                                        <td>{!! tableStatus($item->status) !!}</td>
                                        <td>{!! tableDefault($item->default) !!}</td>
                                        <td>{!! tableActions($item->id, 'language') !!}</td>
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
                        <ul class="pagination pagination-sm float-right">
                            <li class="page-item"><a class="page-link" href="#">«</a></li>
                            <li class="page-item"><a class="page-link" href="#">1</a></li>
                            <li class="page-item"><a class="page-link" href="#">2</a></li>
                            <li class="page-item"><a class="page-link" href="#">3</a></li>
                            <li class="page-item"><a class="page-link" href="#">»</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @include('dashboard::layouts.modals.master__delete_modal')
@endsection
