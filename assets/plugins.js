$(document).ready(function() {
    $('#example').DataTable();

    $('.alert-dismissible').fadeTo(1000, 500).slideUp(500, function () {
        $('.alert-dismissible').alert('close');
    })
})

$('.btn-danger').on('click', function () {
    var id = $(this).data('id');
    var url = $(this).data('url');
    console.log(url);
    $('#form-deactive').attr('action', url + id);
});

$('.btn-success').on('click', function () {
    var id = $(this).data('id');
    var url = $(this).data('url');
    $('#form-activate').attr('action', url + id);
})



