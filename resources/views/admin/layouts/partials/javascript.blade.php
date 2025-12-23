<!-- Helpers -->
<script src="{{ asset('assets/vendor/js/helpers.js') }}"></script>

<!--! Template customizer & Theme config files MUST be included after core stylesheets and helpers.js in the <head> section -->
<!--? Config:  Mandatory theme config file contain global vars & default theme options, Set your preferred theme option in this file.  -->
<script src="{{ asset('assets/js/config.js') }}"></script>

<!-- build:js assets/vendor/js/core.js -->
{{-- <script src="{{ asset('assets/vendor/libs/jquery/jquery.js') }}"></script> --}}
<script src="{{ asset('assets/vendor/libs/popper/popper.js') }}"></script>
<script src="{{ asset('assets/vendor/js/bootstrap.js') }}"></script>
<script src="{{ asset('assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js') }}"></script>

<script src="{{ asset('assets/vendor/js/menu.js') }}"></script>
<!-- endbuild -->


<!-- Main JS -->
<script src="{{ asset('assets/js/main.js') }}"></script>

<script>$( '#basic-usage' ).select2( {
    theme: "bootstrap-5",
    width: $( this ).data( 'width' ) ? $( this ).data( 'width' ) : $( this ).hasClass( 'w-100' ) ? '100%' : 'style',
    placeholder: $( this ).data( 'placeholder' ),
} );</script>

<!-- Place this tag in your head or just before your close body tag. -->
<script async defer src="https://buttons.github.io/buttons.js')}}"></script>

<!-- Custom Toast JS -->
<script src="{{ asset('assets/js/toasts-custom.js') }}"></script>

<script>
    @if(session('success'))
        toastDetails.success.text = "{{ session('success') }}";
        createToast('success');
    @endif

    @if(session('error'))
        toastDetails.error.text = "{{ session('error') }}";
        createToast('error');
    @endif

    @if($errors->any())
        toastDetails.error.text = "{{ $errors->first() }}";
        createToast('error');
    @endif
</script>


@yield('page-script')
