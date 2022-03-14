$(document).ready(function () {

    $(".remove-btn").click(function (e) {

        var $data_url = $(this).data("url");

        swal({
            title: 'Emin Misiniz??',
            text: "Bu İşlem Geri Alınamaz!",
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            cancelButtonText: 'Hayır',
            confirmButtonText: 'Evet'
        }).then(function (result)  {
            if (result.value) {

               window.location.href = $data_url;

            }
        });

    })

})