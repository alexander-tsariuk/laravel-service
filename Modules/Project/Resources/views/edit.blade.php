@extends('dashboard::layouts.master')

@section('content')
    <div class="row">
        <div class="col-12">
            <form id="editItem" action="{{ route('dashboard.project.update', ['itemId' => $item->id]) }}" method="POST">
                @csrf
                @method('PUT')
                @include('project::edit.edit__main_data')
                @include('project::edit.edit__gallery')
                @include('project::edit.edit__content')
                @include('project::edit.edit__meta_tags')
            </form>
        </div>
    </div>

@endsection

@section('footer-scripts')
    <script>
        $(function () {
            let projectId = $('input[name="projectId"]').val();

            $('#dropzone').dropzone({
                url: '/admin/project/gallery-image/' + projectId,
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
        });
    </script>

@endsection
