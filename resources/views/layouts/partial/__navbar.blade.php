<style>
    :root {
        --brand-start: #556ee6;
        --brand-end: #34c38f;
    }

    #page-topbar {
        background: linear-gradient(135deg, var(--brand-start) 0%, var(--brand-end) 100%) !important;
        box-shadow: none;
    }

    .navbar-header .btn.header-item {
        color: #fff !important;
    }

    .navbar-header .btn.header-item:hover,
    .navbar-header .btn.header-item:focus {
        background-color: rgba(255, 255, 255, 0.12) !important;
    }

    .navbar-brand-box {
        background: transparent !important;
    }

    /* light logo only, on gradient bg the dark logo is invisible */
    .navbar-header .logo-dark {
        display: none !important;
    }

    .navbar-header .logo-light {
        display: block !important;
    }

    .navbar-header .header-profile-user {
        border: 2px solid rgba(255, 255, 255, 0.6);
    }

    .navbar-header .dropdown-menu {
        border: none;
        border-radius: 10px;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.15);
    }
</style>

<div class="navbar-header">
    <div class="d-flex">

        <!-- LOGO -->
        <div class="navbar-brand-box">
            <a href="{{ route('dashboard') }}" class="logo logo-dark">
                <span class="logo-sm">
                    <img src="{{ asset('themes/backend/assets/images/logo-sm-dark.png') }}" alt="" height="22">
                </span>
                <span class="logo-lg">
                    <img src="{{ asset('themes/backend/assets/images/logo.png') }}" alt="" height="24">
                </span>
            </a>

            <a href="{{ route('dashboard') }}" class="logo logo-light">
                <span class="logo-sm">
                    <img src="{{ asset('themes/backend/assets/images/logo-sm-light.png') }}" alt=""
                        height="22">
                </span>
                <span class="logo-lg">
                    <img src="{{ asset('themes/backend/assets/images/logo.png') }}" alt="" height="24">
                </span>
            </a>
        </div>

        <!-- Menu Icon -->

        <button type="button" class="btn px-3 font-size-24 header-item waves-effect" id="vertical-menu-btn">
            <i class="mdi mdi-menu"></i>
        </button>
    </div>

    <div class="d-flex">
        <div class="dropdown d-inline-block d-lg-none ms-2">
            <button type="button" class="btn header-item noti-icon waves-effect" id="page-header-search-dropdown"
                data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="mdi mdi-magnify"></i>
            </button>
            <div class="dropdown-menu dropdown-menu-lg dropdown-menu-end p-0"
                aria-labelledby="page-header-search-dropdown">

                <form class="p-3">
                    <div class="form-group m-0">
                        <div class="input-group">
                            <input type="text" class="form-control" placeholder="Search ..."
                                aria-label="Recipient's username">
                            <div class="input-group-append">
                                <button class="btn btn-primary" type="submit"><i class="mdi mdi-magnify"></i></button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <!-- User -->
        <div class="dropdown d-inline-block">
            <button type="button" class="btn header-item waves-effect" id="page-header-user-dropdown"
                data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <img class="rounded-circle header-profile-user"
                    src="{{ asset(file_exists(auth()->user()->profile_photo) ? auth()->user()->profile_photo : 'themes/backend/dist/img/avatar.png') }}"
                    alt="no Image">
            </button>

            <div class="dropdown-menu dropdown-menu-end">
                <!-- item-->
                <a class="dropdown-item" href="{{ route('profile.edit') }}"><i
                        class="mdi mdi-account-circle font-size-16 align-middle me-2 text-muted"></i>
                    <span>Profile</span></a>
                <div class="dropdown-divider"></div>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf

                    <x-dropdown-link :href="route('logout')"
                        onclick="event.preventDefault();
                                               this.closest('form').submit();">
                        {{ __('Log Out') }}
                    </x-dropdown-link>
                </form>
            </div>
        </div>

    </div>
</div>
