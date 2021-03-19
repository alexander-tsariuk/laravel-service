$(function() {
    $('a.delete-item').on('click', function(e){
        e.preventDefault();

        var id = $(this).data('id'),
            route = $(this).data('route');

        $('.modal-delete-item').modal();
    });
});
