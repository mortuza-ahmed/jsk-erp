<meta charset="utf-8" />
<title>{{ config('app.name', 'Laravel') }}</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta content="JSK ERP" name="description" />
<meta content="{{ config('app.name', 'JSK ERP') }}" name="author" />
<meta name="csrf-token" content="{{ csrf_token() }}">
<!-- App favicon -->
<link rel="shortcut icon" href="{{ asset('themes/backend/assets/images/favicon.ico') }}">
<!-- toastr -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
<!-- DataTables -->
<link href="{{ asset('themes/backend/assets/libs/datatables.net-bs4/css/dataTables.bootstrap4.min.css') }}"
    rel="stylesheet" type="text/css" />
<!-- Plugin Css -->
<link href="{{ asset('themes/backend/assets/libs/select2/css/select2.min.css') }}" rel="stylesheet" type="text/css" />
<!-- Bootstrap Css -->
<link href="{{ asset('themes/backend/assets/css/bootstrap.min.css') }}" id="bootstrap-style" rel="stylesheet"
    type="text/css" />
<!-- Icons Css -->
<link href="{{ asset('themes/backend/assets/css/icons.min.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('themes/backend/assets/css/app.min.css') }}" id="app-style" rel="stylesheet" type="text/css" />
<link href="{{ asset('themes/backend/assets/css/style.css') }}" id="app-style" rel="stylesheet" type="text/css" />
