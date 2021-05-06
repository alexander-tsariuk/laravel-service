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
        // Dropzone.autoDiscover = false;
        Dropzone.options.dUpload= {
            url: "{{ route('dashboard.project.uploadGalleryImage', ['itemId' => $item->id]) }}",
            paramName: 'uploadingFile',
            autoProcessQueue: true,
            uploadMultiple: true,
            parallelUploads: 5,
            maxFiles: 5,
            maxFilesize: 1,
            acceptedFiles: ".jpeg,.jpg,.png,.gif",
            addRemoveLinks: true,
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function(file, response){
                if(response.success) {
                    var $item = "<div class=\"col-3 gallery-item border-right\">" +
                        "<img src='/storage"+response.success+"' class='img-fluid'>"+
                        "</div>";

                    $('.gallery-items').append($item);
                }
            }
        };

        $(function () {
            $(document).on('click', 'a.deleteGalleryImage', function (e) {
                e.preventDefault();

                var _this = $(this);
                let imageId = $(this).attr('data-image');

                $.ajax({
                    url: '/admin/project/gallery-image/delete/' + imageId,
                    method: 'DELETE',
                    success: function (data) {
                        if(data.success === true) {
                            toastr.success(data.message);

                            _this.parents('.gallery-item').remove();

                        } else {
                            toastr.error(data.message);
                        }
                    }
                })
            });
        });
    </script>

@endsection
