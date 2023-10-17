@extends('layouts.app')

@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Profile</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Account Pages</a></li>
                            <li class="breadcrumb-item active">Profile</li>
                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-5">

                        <!-- Profile Image -->
                        <div class="card card-primary card-outline">
                            <div class="card-body box-profile">
                                <div class="text-center">
                                    <img class="profile-user-img img-fluid img-circle" src="{{ asset ('img/profile1.jpg') }}"
                                        alt="User profile picture">
                                </div>

                                <h3 class="profile-username text-center">@auth
                                        {{ auth()->user()->name }}
                                    @else
                                        User
                                    @endauth
                                </h3>

                                <p class="text-muted text-center">Admin</p>
                            </div>
                            <!-- /.card-body -->
                        </div>
                        <!-- /.card -->

                        <!-- About Me Box -->
                        <div class="card card-primary">
                            <div class="card-header">
                                <h3 class="card-title">About Me</h3>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                <strong><i class="fas fa-user mr-3"></i>Nama</strong>

                                <p class="text-muted">
                                    {{$name}}
                                </p>

                                <hr>

                                <strong><i class="fas fa-envelope mr-3"></i>  Email</strong>

                                <p class="text-muted">{{$email}}</p>

                                <hr>

                                <strong><i class="fas fa-briefcase mr-3"></i>Role</strong>

                                <p class="text-muted">
                                    {{$role}}
                                </p>

                                <hr>

                            
                            </div>
                            <!-- /.card-body -->
                        </div>
                        <!-- /.card -->
                    </div>
                    <!-- /.col -->
                    <div class="col-md-7">
                        <div class="card">
                            <div class="card-header p-2">
                                <ul class="nav nav-pills">
                                    
                                    <li class="nav-item"><a class="active nav-link" href="#settings" data-toggle="tab">Settings</a>
                                    </li>
                                </ul>
                            </div><!-- /.card-header -->
                            <div class="card-body">
                                <div class="tab-content">

                                    <div class="active tab-pane" id="settings">
                                        @include('components.alert')
                                        <form class="form-horizontal" method="post" action="{{ url('admin/profile')}}">
                                            @csrf
                                            @method('PUT')
                                            <div class="form-group row">
                                                <label for="inputName" class="col-sm-2 col-form-label">Name</label>
                                                <div class="col-sm-10">
                                                    <input type="text" class="form-control" id="inputName"
                                                        placeholder="Name" name="name" value="{{$name}}">
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label for="inputEmail" class="col-sm-2 col-form-label">Email</label>
                                                <div class="col-sm-10">
                                                    <input type="text" class="form-control" id="inputEmail"
                                                        placeholder="Email" name="email" value="{{$email}}">
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label for="inputExperience"
                                                    class="col-sm-2 col-form-label">Password</label>
                                                <div class="col-sm-10">
                                                    <input type="password" class="form-control" id="inputName" name="password"
                                                        value="">
                                                </div>
                                            </div>
                                            
                                            <div class="form-group row">
                                                <div class="offset-sm-2 mt-2 col-sm-10">
                                                    <button type="submit" class="btn btn-md btn-success">Update</button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                    <!-- /.tab-pane -->
                                </div>
                                <!-- /.tab-content -->
                            </div><!-- /.card-body -->
                        </div>
                        <!-- /.card -->
                    </div>
                    <!-- /.col -->
                </div>
                <!-- /.row -->
            </div><!-- /.container-fluid -->
        </section>
    </div>
    <!-- /.content -->
@endsection
