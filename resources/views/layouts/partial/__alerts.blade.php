@if (session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        <strong>Success!</strong> {{ session('success') }}
    </div>
@endif
@if (session('info'))
    <div class="alert alert-info alert-dismissible fade show" role="alert">
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        <strong>Info:</strong> {{ session('info') }}
    </div>
@endif
@if (session('warning'))
    <div class="alert alert-warning alert-dismissible fade show" role="alert">
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        <strong>Warning!</strong> {{ session('warning') }}
    </div>
@endif
@if (session('error'))
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        <strong>Error!</strong> {{ session('error') }}
    </div>
@endif
<script>
    setTimeout(function() {
        document.querySelectorAll('.alert').forEach(function(alert) {
            let bsAlert = new bootstrap.Alert(alert);
            bsAlert.close();
        });
    }, 2000);
</script>
