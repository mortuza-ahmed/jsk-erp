<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <title>Login | {{ config('app.name', 'Laravel') }}</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="Premium Multipurpose Admin & Dashboard Template" name="description" />
    <meta content="{{ config('app.name', 'Laravel') }}" name="author" />

    <!-- App favicon -->
    <link rel="shortcut icon" href="{{ asset('themes/backend/assets/images/favicon.ico') }}">

    <!-- Bootstrap Css -->
    <link href="{{ asset('themes/backend/assets/css/bootstrap.min.css') }}" id="bootstrap-style" rel="stylesheet"
        type="text/css" />
    <!-- Icons Css -->
    <link href="{{ asset('themes/backend/assets/css/icons.min.css') }}" rel="stylesheet" type="text/css" />
    <!-- App Css-->
    <link href="{{ asset('themes/backend/assets/css/app.min.css') }}" id="app-style" rel="stylesheet"
        type="text/css" />

    <style>
        :root {
            --brand-start: #556ee6;
            --brand-end: #34c38f;
            --border-color: #e2e5e8;
        }

        body.auth-bg {
            min-height: 100vh;
            background: linear-gradient(135deg, var(--brand-start) 0%, var(--brand-end) 100%);
            display: flex;
            align-items: center;
        }

        .auth-card {
            border: none;
            border-radius: 16px;
            box-shadow: 0 10px 40px rgba(0, 0, 0, 0.15);
            overflow: hidden;
        }

        .auth-card-header {
            background: linear-gradient(135deg, var(--brand-start) 0%, var(--brand-end) 100%);
            padding: 32px 24px 60px;
            text-align: center;
        }

        .auth-card-header h4 {
            color: #fff;
            font-weight: 600;
            margin-bottom: 4px;
        }

        .auth-card-header p {
            color: rgba(255, 255, 255, 0.85);
            margin-bottom: 0;
            font-size: 14px;
        }

        .auth-logo-wrap {
            margin-top: -48px;
        }

        .auth-logo-wrap img {
            max-height: 40px;
            background: #fff;
            border-radius: 12px;
            padding: 10px 16px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.12);
        }

        .auth-form-wrap {
            padding: 16px 32px 32px;
        }

        /* Input group border wrapper — border lives here, not on individual children,
           so focus highlights the whole group as one piece */
        .input-group {
            border: 1.5px solid var(--border-color);
            border-radius: 8px;
            overflow: hidden;
            transition: border-color .15s ease, box-shadow .15s ease;
        }

        .input-group:focus-within {
            border-color: var(--brand-start);
            box-shadow: 0 0 0 0.15rem rgba(85, 110, 230, 0.15);
        }

        .input-group .form-control,
        .input-group .input-group-text,
        .input-group .btn {
            border: none !important;
            box-shadow: none !important;
        }

        .form-control {
            padding: 10px 14px;
            background-color: #fff;
        }

        .input-group-text {
            background-color: #f3f6f9;
        }

        .input-group.is-invalid,
        .input-group:has(.is-invalid) {
            border-color: #f06565;
        }

        .btn-login {
            border-radius: 8px;
            padding: 10px;
            font-weight: 600;
            background: linear-gradient(135deg, var(--brand-start) 0%, var(--brand-end) 100%);
            border: none;
        }

        .btn-login:hover {
            opacity: 0.92;
        }

        .footer-text {
            color: rgba(255, 255, 255, 0.85);
        }
    </style>
</head>

<body data-topbar="colored" class="auth-bg">

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-7 col-lg-5 col-xl-4">

                <div class="card auth-card mb-4">

                    <div class="auth-card-header">
                        <h4>Welcome Back!</h4>
                        <p>Sign in to continue to {{ config('app.name', 'Laravel') }}</p>
                    </div>

                    <div class="auth-logo-wrap">
                        <div class="text-center">
                            <img src="{{ asset('themes/backend/assets/images/logo.png') }}" alt="logo">
                        </div>
                    </div>

                    <div class="card-body auth-form-wrap">

                        @if (session('status'))
                            <div class="alert alert-success text-center">
                                {{ session('status') }}
                            </div>
                        @endif

                        <!-- Login Form -->
                        <form method="POST" action="{{ route('login') }}">
                            @csrf

                            <!-- Email -->
                            <div class="mb-3">
                                <label class="form-label" for="email">Email / Mobile No</label>
                                <div class="input-group @error('email') is-invalid @enderror">
                                    <span class="input-group-text"><i class="mdi mdi-account-outline"></i></span>
                                    <input type="text" class="form-control"
                                        id="email" name="email" placeholder="Enter email"
                                        value="{{ old('email') }}" required autofocus>
                                </div>
                                @error('email')
                                    <div class="invalid-feedback d-block">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Password -->
                            <div class="mb-3">
                                <label class="form-label" for="userpassword">Password</label>
                                <div class="input-group @error('password') is-invalid @enderror">
                                    <span class="input-group-text"><i class="mdi mdi-lock-outline"></i></span>
                                    <input type="password"
                                        class="form-control"
                                        id="userpassword" name="password" placeholder="Enter password" required
                                        autocomplete="current-password">
                                    <button class="btn btn-light" type="button" id="password-addon">
                                        <i class="mdi mdi-eye-outline"></i>
                                    </button>
                                </div>
                                @error('password')
                                    <div class="invalid-feedback d-block">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Remember Me -->
                            <div class="mb-3 d-flex align-items-center justify-content-between">
                                <div class="form-check">
                                    <input type="checkbox" class="form-check-input" id="customControlInline"
                                        name="remember" {{ old('remember') ? 'checked' : '' }}>
                                    <label class="form-check-label" for="customControlInline">Remember me</label>
                                </div>
                            </div>

                            <!-- Submit -->
                            <div class="d-grid">
                                <button class="btn btn-primary btn-login waves-effect waves-light"
                                    type="submit">Log In</button>
                            </div>
                        </form>
                        <!-- End Login Form -->

                    </div>
                </div>

                <div class="text-center">
                    <p class="footer-text">
                        &copy; {{ date('Y') }} {{ config('app.name', 'Laravel') }}. All rights reserved.
                    </p>
                </div>

            </div>
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

    <!-- Show/hide password toggle -->
    <script>
        document.getElementById('password-addon')?.addEventListener('click', function () {
            const input = document.getElementById('userpassword');
            const icon = this.querySelector('i');
            if (input.type === 'password') {
                input.type = 'text';
                icon.classList.replace('mdi-eye-outline', 'mdi-eye-off-outline');
            } else {
                input.type = 'password';
                icon.classList.replace('mdi-eye-off-outline', 'mdi-eye-outline');
            }
        });
    </script>

</body>

</html>
