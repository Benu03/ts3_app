<form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
    @csrf
</form>
<script src="https://cdnjs.cloudflare.com/ajax/libs/crypto-js/4.0.0/crypto-js.min.js"></script>

<script>
    function openWithSession(event, url, datapassingJson) {
    event.preventDefault();
   
    const datapassing = JSON.parse(datapassingJson);
    const secretKey = '{{ $data['secretKey'] }}';
    const user = btoa(JSON.stringify(datapassing.user) + secretKey);
    const module = btoa(JSON.stringify(datapassing.module) + secretKey);
    const key_module = btoa(JSON.stringify(datapassing.module.key_module)+ secretKey);
    
    const newUrl = `${url}?key_module=${key_module}&user=${user}&module=${module}`;

    window.location.href = newUrl;
    }

    function openWithSessionDev(event, local_url ,url, datapassingJson) {
        event.preventDefault();

        
        Swal.fire({
            title: 'Pilih Environment ?',
            type: 'warning',
            showCancelButton: true,
            reverseButtons: false,
            confirmButtonColor: '#f1c40f', 
            cancelButtonColor: '#3498db',  
            confirmButtonText: 'Local',
            cancelButtonText: 'Development',
        }).then((result) => {
      
            const datapassing = JSON.parse(datapassingJson);
            const secretKey = '{{ $data['secretKey'] }}';
            const user = btoa(JSON.stringify(datapassing.user) + secretKey);
            const module = btoa(JSON.stringify(datapassing.module) + secretKey);
            const key_module = btoa(JSON.stringify(datapassing.module.key_module) + secretKey);

            // if (result.value === true) {
            //     const newUrl = `${local_url}?key_module=${key_module}&user=${user}&module=${module}`;
            //     window.location.href = newUrl;
            // } else {
            //     const newUrl = `${url}?key_module=${key_module}&user=${user}&module=${module}`;
            //     window.location.href = newUrl;
            // }
            if (result.isConfirmed) {
                const newUrl = `${local_url}?key_module=${key_module}&user=${user}&module=${module}`;
                window.location.href = newUrl;
            } else if (result.dismiss === Swal.DismissReason.cancel) {
                const newUrl = `${url}?key_module=${key_module}&user=${user}&module=${module}`;
                window.location.href = newUrl;
            }
        });
    }




</script>


<!-- jQuery -->
<script src="{{ asset('plugins/jquery/jquery.min.js') }}"></script>
<!-- jQuery UI 1.11.4 -->
<script src="{{ asset('plugins/jquery-ui/jquery-ui.min.js') }}"></script>
<!-- jQuery Block UI -->
<script src="{{ asset('plugins/jquery/jquery-block-ui.min.js') }}"></script>
<!-- jQuery Validate -->
<script src="{{ asset('plugins/jquery-validation/jquery.validate.min.js') }}"></script>
<!-- dataTable -->
<script src="{{ asset('plugins/datatables/jquery.dataTables.min.js') }}"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<!-- Bootstrap 4 -->
<script src="{{ asset('plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<!-- Sparkline -->
<script src="{{ asset('plugins/sparklines/sparkline.js') }}"></script>
<!-- ChartJS -->
<script src="{{ asset('plugins/chart.js/Chart.min.js') }}"></script>
<!-- jQuery Knob Chart -->
<script src="{{ asset('plugins/jquery-knob/jquery.knob.min.js') }}"></script>
<!-- daterangepicker -->
<script src="{{ asset('plugins/moment/moment.min.js') }}"></script>
<script src="{{ asset('plugins/daterangepicker/daterangepicker.js') }}"></script>
<!-- datetimepicker -->
<script src="{{ asset('plugins/datetimepicker/js/tempus-dominus.min.js') }}"></script>
<!-- Tempusdominus Bootstrap 4 -->
<script src="{{ asset('plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js') }}"></script>
<!-- Summernote -->
<script src="{{ asset('plugins/summernote/summernote-bs4.min.js') }}"></script>
<!-- Sweetalert2 -->
<script src="{{ asset('plugins/sweetalert2/sweetalert2.min.js') }}"></script>
<!-- overlayScrollbars -->
<script src="{{ asset('plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js') }}"></script>
<!-- dataTable -->
<script src="{{ asset('plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
<script src="{{ asset('plugins/datatables-fixedcolumns/js/dataTables.fixedColumns.min.js') }}"></script>
<!-- dataTable button / export-->
<script src="{{ asset('plugins/datatables-buttons/js/buttons.bootstrap4.min.js') }}"></script>
<script src="{{ asset('plugins/datatables-buttons/js/dataTables.buttons.min.js') }}"></script>
<script src="{{ asset('plugins/datatables-buttons/js/buttons.print.min.js') }}"></script>
<script src="{{ asset('plugins/datatables-buttons/js/buttons.html5.min.js') }}"></script>
<script src="{{ asset('plugins/datatables-buttons/js/jszip.min.js') }}"></script>
<!-- dataTable Group-->
<script src="{{ asset('plugins/datatables-rowgroup/js/dataTables.rowGroup.min.js') }}"></script>
<script src="{{ asset('plugins/datatables-rowgroup/js/rowGroup.bootstrap4.min.js') }}"></script>
<!-- Select 2 -->
<script src="{{ asset('plugins/select2/js/select2.min.js') }}"></script>
<!-- Select Picker -->
<script src="{{ asset('plugins/selectpicker/js/bootstrap-select.min.js') }}"></script>
<!-- Filsave -->
<script src="{{ asset('plugins/filedownload/js/filedownload.min.js') }}"></script>
<!-- AdminLTE App -->
<script src="{{ asset('dist/js/adminlte.js') }}"></script>
<script src="{{ asset('dist/js/pages/dashboard.js') }}"></script>
<script src="{{ asset('dist/js/custom/custom.js') }}"></script>
<!-- PDF Make -->
<script src="{{ asset('plugins/pdfmake/pdfmake.min.js') }}"></script>
<script src="{{ asset('plugins/pdfmake/vfs_fonts.js') }}"></script>

{{-- DateTimePicker Jquery --}}
<script type="text/javascript" src="https://cdn.jsdelivr.net/jquery/latest/jquery.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>

<!-- TOASTR -->
<script src="{{ asset('plugins/toastr/toastr.min.js') }}"></script>

@include('main.lobby.js')
