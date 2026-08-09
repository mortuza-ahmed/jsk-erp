<!-- ================= Core JS ================= -->
<script src="{{ asset('themes/backend/assets/libs/jquery/jquery.min.js') }}"></script>
<script src="{{ asset('themes/backend/assets/libs/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('themes/backend/assets/libs/metismenu/metisMenu.min.js') }}"></script>
<script src="{{ asset('themes/backend/assets/libs/simplebar/simplebar.min.js') }}"></script>
<script src="{{ asset('themes/backend/assets/libs/node-waves/waves.min.js') }}"></script>
<!-- ================= DataTables ================= -->
<script src="{{ asset('themes/backend/assets/libs/datatables.net/js/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('themes/backend/assets/libs/datatables.net-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
<!-- DataTables Init -->
<script src="{{ asset('themes/backend/assets/js/pages/datatables.init.js') }}"></script>
<!-- ================= Form Plugins ================= -->
<script src="{{ asset('themes/backend/assets/libs/select2/js/select2.min.js') }}"></script>
<!-- ================= App JS ================= -->
<script src="{{ asset('themes/backend/assets/js/app.js') }}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

<script>
    $(function() {
        // Setup CSRF for AJAX
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        function playAudio(id) {
            let audio = document.getElementById(id);
            if (audio) audio.play();
        }

        // Success
        @if (session('success'))
            toastr.success("<strong>Success!</strong> {{ session('success') }}");
            playAudio('notification-success-audio');
        @endif

        // Error
        @if (session('error'))
            toastr.error("<strong>Error!</strong> {{ session('error') }}");
            playAudio('notification-error-audio');
        @endif

        // Warning
        @if (session('warning'))
            toastr.warning("<strong>Warning!</strong> {{ session('warning') }}");
            playAudio('notification-error-audio'); // Use error sound for warnings too
        @endif

        // Info
        @if (session('info'))
            toastr.info("<strong>Info!</strong> {{ session('info') }}");
            playAudio('notification-success-audio'); // optional, use success sound
        @endif

        // Validation errors
        @if ($errors->any())
            toastr.error("<strong>Validation Error!</strong> Please fill all required fields.");
            playAudio('notification-error-audio');
        @endif

    });
</script>
