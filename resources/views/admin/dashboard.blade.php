@extends('admin.layouts.app')

@section('content')
    <!-- Page-Title -->
    <div class="page-title-box">
        <div class="container-fluid">
            <div class="row align-items-center">
                <div class="col-md-8">
                    <h4 class="page-title mb-1">Dashboard</h4>
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item active">Welcome to Xoric Dashboard</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <!-- end page title end breadcrumb -->

    <div class="page-content-wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-xl-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-6">
                                    <h5>Bienvenido !</h5>
                                    <p class="text-muted">{{ Auth::user()->name }}</p>
                                </div>

                                <div class="col-5 ml-auto">
                                    <div>
                                        <img src="{{ asset('assets/images/widget-img.png') }}" alt=""
                                            class="img-fluid">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            {{-- <div class="row">
                <div class="col-lg-4">
                    <div class="card">
                        <div class="card-header bg-transparent p-3">
                            <h5 class="header-title mb-0">Sales Status</h5>
                        </div>
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item">
                                <div class="media my-2">

                                    <div class="media-body">
                                        <p class="text-muted mb-2">Number of Sales</p>
                                        <h5 class="mb-0">1,625</h5>
                                    </div>
                                    <div class="icons-lg ml-2 align-self-center">
                                        <i class="uim uim-layer-group"></i>
                                    </div>
                                </div>
                            </li>
                            <li class="list-group-item">
                                <div class="media my-2">
                                    <div class="media-body">
                                        <p class="text-muted mb-2">Sales Revenue </p>
                                        <h5 class="mb-0">$ 42,235</h5>
                                    </div>
                                    <div class="icons-lg ml-2 align-self-center">
                                        <i class="uim uim-analytics"></i>
                                    </div>
                                </div>
                            </li>
                            <li class="list-group-item">
                                <div class="media my-2">
                                    <div class="media-body">
                                        <p class="text-muted mb-2">Average Price</p>
                                        <h5 class="mb-0">$ 14.56</h5>
                                    </div>
                                    <div class="icons-lg ml-2 align-self-center">
                                        <i class="uim uim-ruler"></i>
                                    </div>
                                </div>
                            </li>
                            <li class="list-group-item">
                                <div class="media my-2">
                                    <div class="media-body">
                                        <p class="text-muted mb-2">Product Sold</p>
                                        <h5 class="mb-0">8,235</h5>
                                    </div>
                                    <div class="icons-lg ml-2 align-self-center">
                                        <i class="uim uim-box"></i>
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </div> --}}
            

        </div> <!-- container-fluid -->
    </div>
    <!-- end page-content-wrapper -->
@endsection
