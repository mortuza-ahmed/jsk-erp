@extends('layouts.app')
@section('title', 'Dashboard')
@section('style')
    <style>
        :root {
            --brand-start: #556ee6;
            --brand-end: #34c38f;
        }

        .mini-stat.card-gradient {
            background: linear-gradient(135deg, var(--brand-start) 0%, var(--brand-end) 100%);
            border: none;
            border-radius: 12px;
            overflow: hidden;
        }

        .mini-stat.card-gradient .mini-stat-icon i {
            opacity: 0.25;
        }

        .mini-stat.card-gradient .badge.bg-light {
            color: var(--brand-start) !important;
        }
    </style>
@endsection
@section('content')
    <div class="page-content">
        <div class="container-fluid">
            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-flex align-items-center justify-content-between">
                        <div class="page-title">
                            <h4 class="mb-0 font-size-18">Dashboard</h4>
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item active">Welcome to JSK ERP</li>
                            </ol>
                        </div>

                    </div>
                </div>
            </div>
            <!-- end page title -->

            <!-- Start page content-wrapper -->
            <div class="page-content-wrapper">
                <div class="row">
                    <div class="col-xl-3 col-md-6">
                        <div class="card mini-stat card-gradient position-relative">
                            <div class="card-body">
                                <div class="mini-stat-desc">
                                    <h5 class="text-uppercase verti-label font-size-16 text-white-50">Projects
                                    </h5>
                                    <div class="text-white">
                                        <h5 class="text-uppercase font-size-16 text-white-50">Total Projects</h5>
                                        <h3 class="mb-3 text-white">0</h3>
                                        <div class="">
                                            <span class="badge bg-light text-info"> +11% </span> <span class="ms-2">From
                                                previous period</span>
                                        </div>
                                    </div>
                                    <div class="mini-stat-icon">
                                        <i class="mdi mdi-cube-outline display-2"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-md-6">
                        <div class="card mini-stat card-gradient position-relative">
                            <div class="card-body">
                                <div class="mini-stat-desc">
                                    <h5 class="text-uppercase verti-label font-size-16 text-white-50">Projects
                                    </h5>
                                    <div class="text-white">
                                        <h5 class="text-uppercase font-size-16 text-white-50">Total Projects</h5>
                                        <h3 class="mb-3 text-white">0</h3>
                                        <div class="">
                                            <span class="badge bg-light text-info"> +11% </span> <span class="ms-2">From
                                                previous period</span>
                                        </div>
                                    </div>
                                    <div class="mini-stat-icon">
                                        <i class="mdi mdi-cube-outline display-2"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-md-6">
                        <div class="card mini-stat card-gradient position-relative">
                            <div class="card-body">
                                <div class="mini-stat-desc">
                                    <h5 class="text-uppercase verti-label font-size-16 text-white-50">Projects
                                    </h5>
                                    <div class="text-white">
                                        <h5 class="text-uppercase font-size-16 text-white-50">Total Projects</h5>
                                        <h3 class="mb-3 text-white">0</h3>
                                        <div class="">
                                            <span class="badge bg-light text-info"> +11% </span> <span class="ms-2">From
                                                previous period</span>
                                        </div>
                                    </div>
                                    <div class="mini-stat-icon">
                                        <i class="mdi mdi-cube-outline display-2"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-md-6">
                        <div class="card mini-stat card-gradient position-relative">
                            <div class="card-body">
                                <div class="mini-stat-desc">
                                    <h5 class="text-uppercase verti-label font-size-16 text-white-50">Projects
                                    </h5>
                                    <div class="text-white">
                                        <h5 class="text-uppercase font-size-16 text-white-50">Total Projects</h5>
                                        <h3 class="mb-3 text-white">0</h3>
                                        <div class="">
                                            <span class="badge bg-light text-info"> +11% </span> <span class="ms-2">From
                                                previous period</span>
                                        </div>
                                    </div>
                                    <div class="mini-stat-icon">
                                        <i class="mdi mdi-cube-outline display-2"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- end page-content-wrapper-->
        </div>
    </div>
@endsection
@section('script')
    <script></script>
@endsection
