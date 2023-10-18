@extends('layouts.app')

@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Simple Tables</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Simple Tables</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>
<section class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-12">
          <div class="card">
            <div class="card-header">
              <h3 class="card-title">User Managament</h3>
              <a class="btn btn-md btn-success float-right" href="{{ route('users.create') }}"> + User</a>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              @include('components.alert')
              <table class="table table-bordered">
                <thead>
                  <tr>
                    <th style="width: 10px">No</th>
                    <th>Nama</th>
                    <th>Email</th>
                    <th>Role</th>
                    {{-- <th>Password</th> --}}
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody>
                    @foreach ($user as $key => $item)
                    <tr>
                        <td>
                            <div class="d-flex px-3 py-1">
                                <div class="d-flex flex-column justify-content-center">
                                    <h6 class="mb-0 text-sm">{{ $key + 1 }}</h6>
                                </div>
                            </div>
                        </td>
                        <td>
                            <div class="d-flex px-3 py-1">
                                <div class="d-flex flex-column justify-content-center">
                                    <h6 class="mb-0 text-sm">{{ $item ->name}}</h6>
                                </div>
                            </div>
                        </td>
                        <td>
                            <p class="text-sm mb-0">{{ $item->email }}</p>
                        </td>
                        <td class=" text-sm">
                            <p class="text-sm mb-0">{{ $item->role}}</p>
                        </td>
                        {{-- <td class=" text-sm">
                            <p class="text-sm mb-0">{{ $item->password }}</p>
                        </td> --}}
                        {{-- <td class="align-middle text-end">
                            <div class="d-flex px-3 py-1 justify-content-center align-items-center">
                                <a class="btn-sm bg-gradient-warning text-sm">Edit</p>
                                <a class="btn btn-sm bg-danger text-sm ">Delete</p>
                            </div>
                        </td> --}}
                        <td class="align-middle text-center">
                            <div class="">
                                <a href="{{ route('users.show', $item->id) }}" class="btn btn-sm bg-primary text-white font-weight-bold text-xs" data-toggle="tooltip" data-original-title="Download Files"> 
                                  <li class="fas fa-eye"></li>
                              </a>
                                <a href="{{ route('users.edit', $item->id) }}" class="btn btn-sm bg-warning  text-white font-weight-bold text-xs" data-toggle="tooltip" data-original-title="Edit Posisi"> 
                                     <li class="fas fa-edit"></li>
                                 </a>
                                 <form style="display: inline" action="{{ route ('users.destroy', $item->id)}}" method="POST" >
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger delete-button" id="delete"> <li class="fas fa-trash"></li></button>
                                 </form>
                                
                            </div>
                        </td>
                    </tr>
                    
                    @endforeach
                </tbody>
              </table>
            </div>
            <!-- /.card-body -->
           <div class="card-footer clearfix">
                                <ul class="pagination pagination-sm m-0 float-right">
                                    <li class="page-item {{ $user->onFirstPage() ? 'disabled' : '' }}">
                                        <a class="page-link" href="{{ $user->previousPageUrl() }}">&laquo;</a>
                                    </li>
                                    @for ($i = 1; $i <= $user->lastPage(); $i++)
                                        <li class="page-item {{ $i == $user->currentPage() ? 'active' : '' }}">
                                            <a class="page-link" href="{{ $user->url($i) }}">{{ $i }}</a>
                                        </li>
                                    @endfor
                                    <li
                                        class="page-item {{ $user->currentPage() == $user->lastPage() ? 'disabled' : '' }}">
                                        <a class="page-link" href="{{ $user->nextPageUrl() }}">&raquo;</a>
                                    </li>
                                </ul>
                            </div>
          </div>
        </div>
        
    </div>
  </section>
</div>
@endsection