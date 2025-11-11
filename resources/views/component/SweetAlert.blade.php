<!-- Alerts Unutuk menampilkan pemberitahuan sukses/gagal -->
@if (session('loginError'))
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            Swal.fire({
                icon: 'error',
                title: 'Gagal Masuk',
                text: '{{ session('loginError') }}',
                confirmButtonText: 'OK'
            });
        });
    </script>
@endif

@if ($errors->any())
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var errorMessages = @json($errors->all());
            var combinedErrors = errorMessages.join('<br>'); // Combine all errors into a single message

            Swal.fire({
                icon: 'error',
                title: 'Error!',
                html: combinedErrors, // Use html to display multiple lines
                showConfirmButton: true
            });
        });
    </script>
@endif


{{-- @if (session()->get('error'))
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            Swal.fire({
                icon: 'error',
                title: 'Error!',
                text: "{{ session()->get('error') }}",
                showConfirmButton: true,
            });
        });
    </script>
@endif --}}

@if (session('judol'))
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            Swal.fire({
                icon: 'warning',
                title: 'NIK Terafiliasi Judol !',
                text: "{{ session('warning') }}",
                confirmButtonText: 'OK',
                allowOutsideClick: false
            });
        });
    </script>
@endif



{{-- @if (session()->get('success'))
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            Swal.fire({
                icon: 'success',
                title: 'Success!',
                text: "{{ session()->get('success') }}",
                showConfirmButton: true
            });
        });
    </script>
@endif --}}

{{-- @if (session()->get('success-land'))
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            Swal.fire({
                icon: 'success',
                title: 'Success!',
                text: "{{ session()->get('success-land') }}",
                showConfirmButton: true
            });
        });
    </script>
@endif --}}

@if (session('success-land'))
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const Toast = Swal.mixin({
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                timer: 6000,
                timerProgressBar: true,
                didOpen: (toast) => {
                    toast.addEventListener('mouseenter', Swal.stopTimer)
                    toast.addEventListener('mouseleave', Swal.resumeTimer)
                }
            });

            Toast.fire({
                iconHtml: '<i class="fa-solid fa-circle-check" style="color: #10e032;"></i>', // pakai FontAwesome
                title: "{{ session('success-land') }}",
                customClass: {
                    icon: 'no-border', // opsional, biar style default icon hilang
                    title: 'toast-title'
                }
            });
        });
    </script>
@endif

@if (session('error-land'))
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const Toast = Swal.mixin({
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                timer: 4000,
                timerProgressBar: true,
                didOpen: (toast) => {
                    toast.addEventListener('mouseenter', Swal.stopTimer)
                    toast.addEventListener('mouseleave', Swal.resumeTimer)
                }
            });

            Toast.fire({
                icon: 'error',
                title: "{{ session('error-land') }}"
            });
        });
    </script>
@endif


{{-- @if (count($errors) > 0)
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var errorMessages = @json($errors->all());

            for (var i = 0; i < errorMessages.length; i++) {
                Swal.fire({
                    icon: 'error',
                    title: 'Error!',
                    text: errorMessages[i],
                    showConfirmButton: true
                });
            }
        });
    </script>
@endif --}}

<script>
    function confirmDelete(id) {
        Swal.fire({
            title: 'Hapus Data {{ $title }}',
            text: 'Apakah anda yakin ingin menghapus data ini?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'Hapus',
            cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.isConfirmed) {
                // Submit the corresponding form
                document.getElementById('deleteForm' + id).submit();
            }
        });
    }
</script>

<script>
    function confirmRestore(id) {
        Swal.fire({
            title: 'Pulihkan Akun Ini?',
            // text: 'Apakah anda ingin memulihkan akun ini?',
            icon: 'question',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'Restore',
            cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.isConfirmed) {
                // Submit the corresponding form
                document.getElementById('restoreForm' + id).submit();
            }
        });
    }
</script>

<script>
    function showAlert(icon, title, text) {
        Swal.fire({
            icon: icon,
            title: title,
            text: text,
            showConfirmButton: true
        });
    }
</script>



<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.all.min.js"></script>

<style>
    .alert-fade {
        transition: opacity 0.5s ease-out;
    }

    .fade-out {
        opacity: 0;
        transition: opacity 0.5s ease-out;
    }
</style>
<!-- End Alert -->
