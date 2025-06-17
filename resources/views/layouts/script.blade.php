<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

<script src="{{ asset('template/backend/assets') }}/js/plugins/popper.min.js"></script>
<script src="{{ asset('template/backend/assets') }}/js/plugins/simplebar.min.js"></script>
<script src="{{ asset('template/backend/assets') }}/js/plugins/bootstrap.min.js"></script>
<script src="{{ asset('template/backend/assets') }}/js/fonts/custom-font.js"></script>
<script src="{{ asset('template/backend/assets') }}/js/pcoded.js"></script>
<script src="{{ asset('template/backend/assets') }}/js/plugins/feather.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>


<script src="{{ asset('template/backend/assets') }}/js/plugins/flatpickr.min.js"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

<script>
    document.querySelector('body').classList.add('preset-1');
</script>

<script src="https://code.highcharts.com/highcharts.js"></script>
<script src="https://code.highcharts.com/highcharts-3d.js"></script>
<script src="https://code.highcharts.com/modules/exporting.js"></script>
<script src="https://code.highcharts.com/modules/export-data.js"></script>
<script src="https://code.highcharts.com/modules/accessibility.js"></script>

<script src="{{ asset('template/backend/assets') }}/js/plugins/jquery.dataTables.min.js"></script>
<script src="{{ asset('template/backend/assets') }}/js/plugins/dataTables.bootstrap5.min.js"></script>
<script>
    var table = $('#dom-jqry').DataTable();
</script>

@stack('scripts')
