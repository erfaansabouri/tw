<script>var KTAppSettings = { "breakpoints": { "sm": 576, "md": 768, "lg": 992, "xl": 1200, "xxl": 1400 }, "colors": { "theme": { "base": { "white": "#ffffff", "primary": "#3699FF", "secondary": "#E5EAEE", "success": "#1BC5BD", "info": "#8950FC", "warning": "#FFA800", "danger": "#F64E60", "light": "#E4E6EF", "dark": "#181C32" }, "light": { "white": "#ffffff", "primary": "#E1F0FF", "secondary": "#EBEDF3", "success": "#C9F7F5", "info": "#EEE5FF", "warning": "#FFF4DE", "danger": "#FFE2E5", "light": "#F3F6F9", "dark": "#D6D6E0" }, "inverse": { "white": "#ffffff", "primary": "#ffffff", "secondary": "#3F4254", "success": "#ffffff", "info": "#ffffff", "warning": "#ffffff", "danger": "#ffffff", "light": "#464E5F", "dark": "#ffffff" } }, "gray": { "gray-100": "#F3F6F9", "gray-200": "#EBEDF3", "gray-300": "#E4E6EF", "gray-400": "#D1D3E0", "gray-500": "#B5B5C3", "gray-600": "#7E8299", "gray-700": "#5E6278", "gray-800": "#3F4254", "gray-900": "#181C32" } }, "font-family": "Poppins" };</script>
<script src="{{ asset('admin-assets/plugins/global/plugins.bundle.js') }} "></script>
<script src="{{ asset('admin-assets/plugins/custom/prismjs/prismjs.bundle.js') }}"></script>
<script src="{{ asset('global-assets/js/datepicker/bootstrap-datepicker.min.js') }}"></script>
<script src="{{ asset('global-assets/js/datepicker/bootstrap-datepicker.fa.min.js') }}"></script>
<script src="{{ asset('admin-assets/js/scripts.bundle.js') }}"></script>
<script src="{{ asset('admin-assets/js/pages/crud/forms/widgets/bootstrap-select.js') }}"></script>

<script>
    // Function to initialize Select2 with AJAX options

    function initializeSelect2() {
        $(".persian-datepicker").datepicker({
            isRTL: true,
            dateFormat: "yy/m/d",
        });
    }

    // Call the initializeSelect2 function to set up the select2 element
    initializeSelect2();


</script>
@include('admin.partials.toastr')
