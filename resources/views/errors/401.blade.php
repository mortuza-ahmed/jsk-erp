<!doctype html>
<html lang="en">

<head>
    @include('layouts.partial.__header')
</head>

<body data-topbar="colored">

    <!-- <body data-layout="horizontal" data-topbar="colored"> -->

    <!-- Background -->
    <div class="account-pages"></div>

    <!-- Begin page -->
    <div class="wrapper-page">
        <div class="card">
            <div class="card-block">

                <div class="ex-page-content text-center">
                      <h1 class="text-dark">
                        <span class="text-danger">4</span><span class="text-success">0</span><span
                            class="text-info">1</span>!
                    </h1>
                    <h4 class="">Sorry, page not found</h4><br>
                    <a class="btn btn-info mb-5 waves-effect waves-light" href="{{ route('dashboard') }}"><i
                            class="mdi mdi-home"></i>
                        Back to Dashboard</a>
                </div>

            </div>
        </div>

        <div class="mt-5 text-center">
            <p class="text-muted">©
                <script>
                    document.write(new Date().getFullYear())
                </script> © <span class="d-none d-sm-inline-block"> Crafted with <i
                        class="mdi mdi-heart text-primary"></i> by
                    {{ config('app.name', 'Laravel') }}.</span>
            </p>
        </div>

    </div>

    <!-- Right bar overlay-->
    <div class="rightbar-overlay"></div>

    <!-- JAVASCRIPT -->
    @include('layouts.partial.__scripts')

</body>

</html>
