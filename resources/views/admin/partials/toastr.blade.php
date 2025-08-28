<script>
    @if(count($errors) > 0)
        @foreach($errors->all() as $error)
        toastr.options.rtl = true;
    toastr.error("{{ $error }}");
    @endforeach
    @endif
</script>
