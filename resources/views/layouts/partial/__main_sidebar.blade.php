<div data-simplebar class="h-100">
    <div class="user-details">
        <div class="d-flex">
            <div class="me-2">
                <img src="{{ asset('themes/backend/assets/images/users/avatar-4.jpg') }}" alt=""
                    class="avatar-md rounded-circle">
            </div>
            <div class="user-info w-100">
                <div class="dropdown">
                    <a href="#" class="dropdown-toggle" data-bs-toggle="dropdown" aria-haspopup="true"
                        aria-expanded="false">
                        {{ auth()->user()->name ?? 'Donald Johnson' }}
                        <i class="mdi mdi-chevron-down"></i>
                    </a>
                    <ul class="dropdown-menu">
                        <li><a href="{{ route('profile.edit') }}" class="dropdown-item"><i
                                    class="mdi mdi-account-circle text-muted me-2"></i>
                                Profile
                            </a></li>
                        <li>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <a href="{{ route('logout') }}" class="dropdown-item"
                                    onclick="event.preventDefault(); this.closest('form').submit();">
                                    <i class="mdi mdi-power text-muted me-2"></i>
                                    Logout
                                </a>
                            </form>
                        </li>
                    </ul>
                </div>

                <p class="text-white-50 m-0">{{ ucfirst(auth()->user()->role ?? 'Administrator') }}</p>
            </div>
        </div>
    </div>
    <!--- Sidemenu -->
    <div id="sidebar-menu">
        <!-- Left Menu Start -->
        <ul class="metismenu list-unstyled" id="side-menu">
            {{-- Dashboard --}}
            @php
                $user = Auth::user();
                $roleName = $user->role;
            @endphp
            @can('dashboard')
                <li class="{{ Route::currentRouteName() == 'dashboard' ? 'mm-active' : '' }}">
                    <a href="{{ route('dashboard') }}" class="waves-effect">
                        <i class="mdi mdi-view-dashboard-outline"></i>
                        <span>Dashboard</span>
                    </a>
                </li>
            @endcan
            {{-- projects --}}
            @php
                $subMenu = ['projects.index', 'projects.create', 'projects.edit'];
            @endphp
            <li class="{{ in_array(Route::currentRouteName(), $subMenu) ? 'mm-active' : '' }}">
                <a href="javascript:void(0);"
                    class="has-arrow waves-effect {{ in_array(Route::currentRouteName(), $subMenu) ? 'mm-active' : '' }}">
                    <i class="mdi mdi-briefcase-variant-outline"></i>
                    <span>Projects</span>
                </a>
                <ul class="sub-menu">

                    @php
                        $subSubMenu = ['projects.index', 'projects.create', 'projects.edit','projects.collectionEntry'];
                    @endphp
                    <li class="{{ in_array(Route::currentRouteName(), $subSubMenu) ? 'mm-active' : '' }}">
                        <a href="{{ route('projects.index') }}">Project Lists</a>
                    </li>
                    <li class="{{ in_array(Route::currentRouteName(), $subSubMenu) ? 'mm-active' : '' }}">
                        <a href="{{ route('projects.collectionEntry') }}">Collection Entry</a>
                    </li>
                </ul>
            </li>
            {{-- end projects --}}
            @can('user')
                <li class="{{ Route::currentRouteName() == 'user.index' ? 'mm-active' : '' }}">
                    <a href="{{ route('user.index') }}" class="waves-effect">
                        <i class="mdi mdi-account-outline"></i>
                        <span>Users</span>
                    </a>
                </li>
            @endcan
            {{--  Menu --}}
            @php
                $subMenu = ['permission.index', 'permission.create', 'permission.edit'];
            @endphp
            <li class="{{ in_array(Route::currentRouteName(), $subMenu) ? 'mm-active' : '' }}">
                <a href="javascript:void(0);"
                    class="has-arrow waves-effect {{ in_array(Route::currentRouteName(), $subMenu) ? 'mm-active' : '' }}">
                    <i class="mdi mdi-shield-account-outline"></i>
                    <span>User Permissions</span>
                </a>
                <ul class="sub-menu">
                    @php
                        $subSubMenu = ['role.index', 'role.create', 'role.edit'];
                    @endphp
                    <li class="{{ in_array(Route::currentRouteName(), $subSubMenu) ? 'mm-active' : '' }}">
                        <a href="{{ route('role.index') }}">Role Menu</a>
                    </li>
                    @php
                        $subSubMenu = ['user_assign_role.index', 'user_assign_role.create', 'user_assign_role.edit'];
                    @endphp
                    <li class="{{ in_array(Route::currentRouteName(), $subSubMenu) ? 'mm-active' : '' }}">
                        <a href="{{ route('user_assign_role') }}">User Assign Role</a>
                    </li>
                </ul>
            </li>
        </ul>
    </div>
    <!-- Sidebar -->
</div>
</div>
