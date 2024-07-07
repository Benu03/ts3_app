@include('layout.blockUI')

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

</script>
<script>
    /* GLOBAL JS */
    var debug = '{{config("static.app_debug")}}';
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

    function close_modal(elem){
        $(".modal-backdrop").remove();
        elem.closest('.modal').modal('hide');
    }

    toastr.options = {
        "closeButton": true,
        "debug": false,
        "progressBar": true,
        "positionClass": "toast-top-right",
        "showDuration": "300",
        "hideDuration": "1000",
        "timeOut": "5000",
        "extendedTimeOut": "1000",
        "showEasing": "swing",
        "hideEasing": "linear",
        "showMethod": "fadeIn",
        "hideMethod": "fadeOut"
    };
</script>
