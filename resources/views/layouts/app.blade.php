<!doctype html>
<html lang="en">


<head>
    @include('layouts.partial.__header')
    @yield('style')
</head>

<body data-topbar="colored">
    <div id="layout-wrapper">
        <header id="page-topbar">
            @include('layouts.partial.__navbar')
        </header>
        <div class="vertical-menu">
            @include('layouts.partial.__main_sidebar')
        </div>
        <div class="main-content">
            @yield('content')
            <footer class="footer">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-sm-12 text-center">
                            <script>
                                document.write(new Date().getFullYear())
                            </script> © <span class="d-none d-sm-inline-block"> Crafted with <i
                                    class="mdi mdi-heart text-primary"></i> by
                                {{ config('app.name', 'Laravel') }}.</span>
                        </div>
                    </div>
                </div>
            </footer>
        </div>
    </div>
    @include('layouts.partial.__media_files')
    @include('layouts.partial.__scripts')
    @yield('script')
</body>

</html>
