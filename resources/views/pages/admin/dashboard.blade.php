@extends('layouts.app')

@section('content')
    <div class="content-wrapper">
        <header class="mb-3">
            <a href="#" class="burger-btn d-block d-xl-none">
                <i class="bi bi-justify fs-3"></i>
            </a>
        </header>
        <nav aria-label="breadcrumb">
            {{ Breadcrumbs::render('admin.dashboard') }}
        </nav>
        <div class="page-content">
            <div class="card mt-2">
                <div class="card-body py-4 px-5">

                    <div class="d-flex align-items-center">
                        <div class="avatar avatar-xl">
                            @if (auth()->check() && auth()->user()->role == 'user')
                                @auth
                                    @if (auth()->user()->intern && auth()->user()->intern->photo)
                                        <img src="{{ asset('uploads/photo/' . auth()->user()->intern->photo) }}"
                                            alt="Profile User">
                                    @else
                                        <img src="{{ asset('admin/assets/compiled/jpg/2.jpg') }}" alt="Profile User">
                                    @endif
                                @endauth
                            @endif
                            @if (auth()->check() && auth()->user()->role == 'admin')
                                <img src="{{ asset('img/admin.jpg') }}" alt="Profile Admin">
                            @endif
                        </div>
                        <div class="ms-4 name">
                            <h4 class="font-bold">Halo, Welcome</h4>
                            <h5 class="text-primary mb-0">
                                @auth
                                    {{ auth()->user()->name }}
                                @else
                                    Kadang Koding
                                @endauth
                            </h5>
                        </div>
                    </div>


                </div>
            </div>
            <section class="row">
                <div class="col-12 col-lg-12">
                    <div class="row">
                        <div class="page-heading">
                            <h4>Dashboard</h4>
                        </div>
                        <div class="col-12 col-lg-3 col-md-12">
                            <div class="card">
                                <div class="card-body px-4 py-4">
                                    <div class="row">
                                        <div
                                            class="col-xs-1 col-sm-3 col-md-2 col-lg-3 col-xl-3 col-xxl-3 d-flex justify-content-start ">
                                            <div class="stats-icon purple mb-2">
                                                <i class="iconly-boldAdd-User"></i>
                                            </div>
                                        </div>
                                        <div class="col-xs-3 col-sm-9 col-md-10 col-lg-9 col-xl-9 col-xxl-9">
                                            <h6 class="text-muted font-semibold">Total Pendaftar</h5>
                                                <h6 class="font-extrabold mb-0">{{ $totalPendaftar }}</h6>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-lg-3 col-md-12">
                            <div class="card">
                                <div class="card-body px-4 py-4">
                                    <div class="row">
                                        <div
                                            class="col-xs-1 col-sm-3 col-md-2 col-lg-3 col-xl-3 col-xxl-3 d-flex justify-content-start ">
                                            <div class="stats-icon blue mb-2">
                                                <i class="iconly-boldProfile"></i>
                                            </div>
                                        </div>
                                        <div class="col-xs-3 col-sm-9 col-md-10 col-lg-9 col-xl-9 col-xxl-9">
                                            <h6 class="text-muted font-semibold">Total Pemagang</h6>
                                            <h6 class="font-extrabold mb-0">{{ $totalPemagang }}</h6>
                                            {{-- <a hre class="mt-2 text-sm "></a> --}}

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-lg-3 col-md-12">
                            <div class="card">
                                <div class="card-body px-4 py-4">
                                    <div class="row">
                                        <div
                                            class="col-xs-1 col-sm-3 col-md-2 col-lg-3 col-xl-3 col-xxl-3 d-flex justify-content-start ">
                                            <div class="stats-icon green mb-2">
                                                <i class="iconly-boldBookmark"></i>
                                            </div>
                                        </div>
                                        <div class="col-xs-3 col-sm-9 col-md-10 col-lg-9 col-xl-9 col-xxl-9">
                                            <h6 class="text-muted font-semibold">Total Posisi</h6>
                                            <h6 class="font-extrabold mb-0">{{ $totalPosisi }}</h6>


                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-12 col-lg-3 col-md-12">
                            <div class="card">
                                <div class="card-body px-4 py-4">
                                    <div class="row">
                                        <div
                                            class="col-xs-1 col-sm-3 col-md-2 col-lg-3 col-xl-3 col-xxl-3 d-flex justify-content-start ">
                                            <div class="stats-icon red mb-2">
                                                <i class="iconly-boldTime-Circle"></i>
                                            </div>
                                        </div>
                                        <div class="col-xs-3 col-sm-9 col-md-10 col-lg-9 col-xl-9 col-xxl-9">
                                            <h6 class="text-muted font-semibold">Pending</h6>
                                            <h6 class="font-extrabold mb-0">{{ $totalPending }}</h6>


                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>

                </div>

            </section>
        </div>
    </div>
@endsection
