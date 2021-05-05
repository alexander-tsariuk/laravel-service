$(function($) {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    var $uploadInput = $('input.upload-file');

    if($uploadInput.length) {
        $uploadInput.on('change', function (e) {
            e.preventDefault();

            sendFileImage($(this).data('object'), $(this).data('id'), $(this)[0].files[0]);
        });
    }

    var $deleteImage = $('input[name="deleteImage"]');

    if($deleteImage.length) {
        $deleteImage.on('click', function (e) {
            e.preventDefault();

            $.ajax({
                url: '/admin/' + $(this).data('object') + '/delete-image/' + $(this).data('id'),
                type: 'POST',
                dataType: 'json',
                success: function (response) {
                    if(response.success === true) {
                        $('div#image-area').empty();
                        $('input.upload-file').removeClass('d-none');
                        $('input.deleteImage').addClass('d-none');
                        toastr.success("Изображение успешно удалено!");
                    } else {
                        toastr.error(response.message);
                    }
                }
            });
        });
    }

    $(".dropzone").dropzone({ url: "/file/post" });
});

function sendFileImage(route, itemId, fileObject) {
    var formData = new FormData();

    formData.append('uploadingFile', fileObject);
    formData.append('directory', route);

    var $imageArea = $('#image-area');

    $.ajax({
        url: '/admin/' + route + '/upload-image/' + itemId,
        type: 'POST',
        dataType: 'json',
        data: formData,
        processData: false,  // tell jQuery not to process the data
        contentType: false,  // tell jQuery not to set contentType
        success: function (response) {
            if(response.success === false) {
                toastr.error(response.message);
            } else {
                if($imageArea.length) {
                    $imageArea.empty().append('<img src="/storage/'+response.file+'" class="img-fluid" style="max-width: 300px;"/>');
                }
                $('input.upload-file').addClass('d-none');
                $('input.deleteImage').removeClass('d-none');

                toastr.success(response.messages);
            }
        }
    });
}

function sendFileImageEditor(insertData, file, editor) {
    var formData = new FormData();

    formData.append('uploadingFile', file);
    formData.append('directory', insertData.route);

    var $imageArea = $('#image-area');

    $.ajax({
        url: '/admin/' + insertData.route + '/upload-image/' + insertData.directory,
        type: 'POST',
        dataType: 'json',
        data: formData,
        processData: false,  // tell jQuery not to process the data
        contentType: false,  // tell jQuery not to set contentType
        success: function (response) {
            if(response.success === false) {
                toastr.error(response.message);
            } else {
                let html = $(editor).summernote('code');

                let image = "<img src='/storage"+response.file+"'/>"

                $(editor).summernote("code", html + image, 'filename');
                toastr.success(response.messages);
            }
        }
    });
}
