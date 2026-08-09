<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <title>{{ config('app.name', 'Laravel') }} - Reset Password</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="Password Reset Page" name="description" />
    <meta content="{{ config('app.name', 'Laravel') }}" name="author" />
    <!-- App favicon -->
    <link rel="shortcut icon" href="{{ asset('themes/backend/assets/images/favicon.ico') }}">

    <!-- Bootstrap Css -->
    <link href="{{ asset('themes/backend/assets/css/bootstrap.min.css') }}" id="bootstrap-style" rel="stylesheet"
        type="text/css" />
    <!-- Icons Css -->
    <link href="{{ asset('themes/backend/assets/css/icons.min.css') }}" rel="stylesheet" type="text/css" />
    <!-- App Css-->
    <link href="{{ asset('themes/backend/assets/css/app.min.css') }}" id="app-style" rel="stylesheet" type="text/css" />
</head>

<body data-topbar="colored">

    <div class="account-pages"></div>
    <div class="wrapper-page">

        <div class="card">
            <div class="card-body">

                <div class="auth-logo">
                    <h3 class="text-center">
                        <a href="{{ route('dashboard') }}" class="logo d-block my-4">
                            <img src="{{ asset('themes/backend/assets/images/logo.png') }}" class="logo-dark mx-auto"
                                height="30" alt="logo-dark">
                            <img src="{{ asset('themes/backend/assets/images/logo.png') }}" class="logo-light mx-auto"
                                height="30" alt="logo-light">
                        </a>
                    </h3>
                </div>

                <div class="p-3">
                    <h4 class="text-muted font-size-18 mb-3 text-center">Reset Password</h4>
                    <div class="alert alert-info" role="alert">
                        Enter your email and instructions will be sent to you!
                    </div>

                    <!-- Forgot Password Form -->
                    <form class="form-horizontal" method="POST" action="{{ route('password.email') }}">
                        @csrf

                        <div class="mb-3">
                            <label class="form-label" for="email">Email</label>
                            <input type="email" class="form-control @error('email') is-invalid @enderror"
                                id="email" name="email" placeholder="Enter your email"
                                value="{{ old('email') }}" required autofocus>
                            @error('email')
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3 row">
                            <div class="col-12 text-end">
                                <button class="btn btn-primary w-md waves-effect waves-light" type="submit">
                                    Email Password Reset Link
                                </button>
                            </div>
                        </div>
                    </form>
                    <!-- End Forgot Password Form -->

                    <div class="text-center mt-3">
                        <a href="{{ route('login') }}" class="text-muted">Remembered your password? Sign In</a>
                    </div>

                </div>

            </div>
        </div>

        <div class="text-center mt-4">
            <p class="text-muted">
                ©
                <script>
                    document.write(new Date().getFullYear())
                </script> with <i class="mdi mdi-heart text-primary"></i> by
                {{ config('app.name', 'Laravel') }}
            </p>
        </div>

    </div>

    <!-- JS Libraries -->
    <script src="{{ asset('themes/backend/assets/libs/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('themes/backend/assets/libs/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('themes/backend/assets/libs/metismenu/metisMenu.min.js') }}"></script>
    <script src="{{ asset('themes/backend/assets/libs/simplebar/simplebar.min.js') }}"></script>
    <script src="{{ asset('themes/backend/assets/libs/node-waves/waves.min.js') }}"></script>
    <script src="{{ asset('themes/backend/assets/libs/jquery-sparkline/jquery.sparkline.min.js') }}"></script>
    <script src="{{ asset('themes/backend/assets/js/app.js') }}"></script>

</body>

</html>
