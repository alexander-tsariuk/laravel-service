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
                    $imageArea.empty().append('<img src="/storage/'+response.file+'" class="img-fluid" style="max-width: 200px;"/>');
                }

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
