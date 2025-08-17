@include('layouts.blockUI')
<script>
    /* DATATABLE */
    $.fn.dataTable.ext.errMode = 'none';
    $.extend(true, $.fn.dataTable.defaults, {
        language:  {
            processing: '<div class="text-center"><i class="fa fa-spinner fa-spin fa-3x fa-fw text-primary"></i></div> <div class="text-center"> <span>Processing...</span></div>'
        },
    });
    /* DATATABLE */
    var matches = document.querySelectorAll(".os-content-glue");
    var match = $('body').hasClass('sidebar-collapse');
</script>
<script>
    // Tootip
    $('[data-toggle="tooltip"]').tooltip();
    // End Tooltip
    // Logout Popup
    $('.loglog').on('click', function() {
        Swal.fire({
            title: 'Are you sure to logout ?',
            type: 'warning',
            showCancelButton: true,
            reverseButtons: true,
            confirmButtonColor: '#30347a',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes',
            cancelButtonText: 'Cancel',
        }).then((result) => {
            if (result.value === true) {
                $('#logout-form').submit()
            }
        })
    })
    // End Logout
</script>
<script>
    /* GLOBAL JS */
    var debug = '{{config("_static.app_debug")}}';
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        statusCode: {
            401: function(request, status, error, other) {
                if(request.responseJSON.error == 'session expired'){
                    Swal.fire({
                        title: request.responseJSON.message,
                        type: 'warning',
                        showCancelButton: true,
                        reverseButtons: true,
                        confirmButtonColor: '#30347a',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Relogin',
                        cancelButtonText: 'Close',
                    }).then((result) => {
                        if (result.value === true) {
                            window.location.href = '/';
                        }
                    })
                } else if(request.responseJSON.error == 'user access unauthorized'){
                    Swal.fire(
                        "",
                        request.responseJSON.message,
                        'error'
                    )
                } else {
                    Swal.fire(
                        "",
                        "Something Wrong",
                        'error'
                    )
                }
            },
            419: function() {
                window.location.href = '/';
            },
            500: function(request) {
                if(debug){
                    Swal.fire(
                        "",
                        request.responseJSON.message,
                        'error'
                    )
                }
            }
        },
        error: function(error) {
            $.unblockUI();
            console.log("Conection Failed, please Try again!!!");
        }
    });

    var page_title = "{{$page_title}}";
    var page_url = "{{$page_url}}";

    console.log(page_title,page_url);

    viewPage(page_url,page_title);


    // $('body').on('collapsed.lte.sidebar', function () {
    //     // Saat sidebar collapse, ubah teks brand menjadi "SIA"
    //     $("#brandText").text("SIA");
    // });

    // $('body').on('expanded.lte.sidebar', function () {
    //     // Saat sidebar expand, ubah teks brand menjadi "SYSTEM INTERNAL AUDIT"
    //     $("#brandText").text("SYSTEM INTERNAL AUDIT");
    // });

</script>
