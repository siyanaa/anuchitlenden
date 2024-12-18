<!-- ===============================================-->
<!--    JavaScripts from dashboard-->
<!-- ===============================================-->

<script src="{{ asset('js/custom.js') }}"></script>

<script src="{{ asset('adminassets/assets/jquery/dist/jquery.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('adminassets/assets/jquery-validation/dist/jquery.validate.min.js') }}" type="text/javascript">
</script>
<script src="{{ asset('adminassets/assets/toastr/toastr.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('adminassets/assets/datatables.net/js/jquery.dataTables.min.js') }}" type="text/javascript">
</script>
<script src="{{ asset('adminassets/assets/datatables.net/js/dataTables.responsive.min.js') }}" type="text/javascript">
</script>
<script src="{{ asset('adminassets/assets/datatables.net/js/dataTables.buttons.min.js') }}" type="text/javascript">
</script>
<script src="{{ asset('adminassets/assets/jquery-ui/jquery-ui.min.js') }}" type="text/javascript"></script>
{{-- <script src="//cdn.datatables.net/1.10.7/js/jquery.dataTables.min.js"></script> --}}
<script src="{{ asset('adminassets/vendors/popper/popper.min.js') }}"></script>
<script src="{{ asset('adminassets/vendors/bootstrap/bootstrap.min.js') }}"></script>
<script src="{{ asset('adminassets/vendors/anchorjs/anchor.min.js') }}"></script>
<script src="{{ asset('adminassets/vendors/is/is.min.js') }}"></script>
<script src="{{ asset('adminassets/vendors/echarts/echarts.min.js') }}"></script>
<script src="{{ asset('adminassets/vendors/fontawesome/all.min.js') }}"></script>
<script src="{{ asset('adminassets/vendors/lodash/lodash.min.js') }}"></script>
<script src="https://polyfill.io/v3/polyfill.min.js?features=window.scroll"></script>
<script src="{{ asset('adminassets/vendors/list.js/list.min.js') }}"></script>
<script src="{{ asset('adminassets/assets/js/theme.js') }}"></script>
{{-- <script src="{{ asset('adminassets/wwwroot/assets/nepali.datepicker.v3.7/js/nepali.datepicker.v3.7.min.js') }}"
    type="text/javascript"></script> --}}
<script src="{{ asset('adminassets/assets/select2/dist/js/select2.min.js') }}"></script>
<script src="{{ asset('adminassets/assets/jquery-mask/dist/jquery.mask.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('adminassets/scripts/language.js') }}"></script>
{{-- <script src="{{ asset('adminassets/scripts/common.js') }}"></script> --}}
<script src="{{ asset('adminassets/assets/js/flatpickr.js') }}"></script>


<script type="text/javascript">
    InitializeUnicodeNepali();
</script>

<script src="{{ asset('summernote/summernote-lite.min.js') }}"></script>
<script>
    $('#summernote').summernote({
    placeholder: 'Your Content Here..',
    tabsize: 2,
    height: 100,
  });
  
</script>


<script src="http://nepalidatepicker.sajanmaharjan.com.np/nepali.datepicker/js/nepali.datepicker.v4.0.1.min.js" type="text/javascript"></script>

<script type="text/javascript">
    window.onload = function() {
        var mainInput = document.getElementById("nepali-datepicker");
            /* Initialize Datepicker with options */
        mainInput.nepaliDatePicker({
            dateFormat: "YYYY-MM-DD",
            ndpYear: true,
            ndpMonth: true,
            ndpYearCount: 200
        });
    };


</script>


<!-- Add jQuery library -->
<script src="https://code.jquery.com/jquery-3.1.1.js" integrity="sha256-16cdPddA6VdVInumRGo6IbivbERE8p7CQR3HzTBuELA="
    crossorigin="anonymous"></script>


<!-- DataTables  & Plugins -->
<script src="{{ asset('plugins/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
<script src="{{ asset('plugins/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
<script src="{{ asset('plugins/datatables-responsive/js/responsive.bootstrap4.min.js') }}"></script>
<script src="{{ asset('plugins/datatables-buttons/js/dataTables.buttons.min.js') }}"></script>
<script src="{{ asset('plugins/datatables-buttons/js/buttons.bootstrap4.min.js') }}"></script>
<script src="{{ asset('plugins/jszip/jszip.min.js') }}"></script>
<script src="{{ asset('plugins/pdfmake/pdfmake.min.js') }}"></script>
<script src="{{ asset('plugins/pdfmake/vfs_fonts.js') }}"></script>
<script src="{{ asset('plugins/datatables-buttons/js/buttons.html5.min.js') }}"></script>
<script src="{{ asset('plugins/datatables-buttons/js/buttons.print.min.js') }}"></script>
<script src="{{ asset('plugins/datatables-buttons/js/buttons.colVis.min.js') }}"></script>

<!-- Select2 -->
<script src="{{ asset('plugins/select2/js/select2.full.min.js') }}"></script>


<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"
integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous">
</script>


{{-- <script type="module" src="{{ mix('js/custom.js') }}"></script> --}}

<script>
    $(document).ready(function() {
        $('.print-window').click(function() {
            window.print();
        });
    });
</script>