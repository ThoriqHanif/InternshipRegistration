@extends('layouts.app')

@section('content')
<div class="content-wrapper">
    
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Edit pemagang</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Data</a></li>
              <li class="breadcrumb-item active">Intern Management</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <!-- left column -->
          <div class="col-md-12">
            <!-- general form elements -->
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Form Edit Pemagang</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form method="POST" action="{{route ('intern.update', $id)}}" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="">
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-body">
                                    <p class="text-uppercase text-sm">User Information</p>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <input type="hidden" name="id" value="{{ $id }}">
                                            <div class="form-group">
                                                <label for="example-text-input" class="form-control-label">Email address<span class="text-danger"> *</span></label>
                                                <input class="form-control @error('email') is-invalid @enderror" type="email" value="{{$email}}" name="email" placeholder="Masukkan Email" >
                                                @error('email')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                                    
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="example-text-input" class="form-control-label">Nama Lengkap<span class="text-danger"> *</span></label>
                                                <input class="form-control  @error('full_name') is-invalid @enderror" type="text" value="{{$full_name}}" name="full_name" placeholder="Masukkan Nama Lengkap" >
                                                @error('full_name')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                                    
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="example-text-input" class="form-control-label">Nama Panggilan<span class="text-danger"> *</span></label>
                                                <input class="form-control  @error('username') is-invalid @enderror" type="text" value="{{$username}}" name="username" placeholder="Masukkan Nama Panggilan" >
                                                @error('username')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                                    
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="example-text-input" class="form-control-label">No Telephone<span class="text-danger"> *</span></label>
                                                <input class="form-control @error('phone_number') is-invalid @enderror" type="number" value="{{$phone_number}}" name="phone_number" placeholder="Masukkan Telp" >
                                                @error('phone_number')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                                    
                                                @enderror
                                            </div>  
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="example-text-input" class="form-control-label">Jenis Kelamin<span class="text-danger"> *</span></label>
                                                
                                                <select class="form-select form-control @error('gender') is-invalid @enderror" name="gender">
                                                    <option value="" selected >Pilih Jenis Kelamin</option>
                                                    @foreach ($genders as $key => $value)
                                                        <option value="{{ $key }}" {{ $gender == $key ? 'selected' : '' }}>
                                                            {{ $value }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                                
                                                @error('gender')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                                    
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <hr class="horizontal dark">
                                    <p class="text-uppercase text-sm">School Information</p>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="example-text-input" class="form-control-label">Asal Sekolah<span class="text-danger"> *</span></label>
                                                <input class="form-control @error('school') is-invalid @enderror" type="text" value="{{$school}}" name="school" placeholder="Masukkan Asal Sekolah" >
                                                @error('school')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                                    
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="example-text-input" class="form-control-label">Jurusan / Prodi<span class="text-danger"> *</span></label>
                                                <input class="form-control @error('major') is-invalid @enderror" type="text" value="{{$major}}" name="major" placeholder="Masukkan Jurusan" >
                                                @error('major')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                                    
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <hr class="horizontal dark">
                                    <p class="text-uppercase text-sm">Contact Information</p>
                                    <div class="row">
                                        <div class="col-md-12">
                                            
                                            <div class="form-group">
                                                <label for="example-text-input" class="form-control-label">Alamat<span class="text-danger"> *</span></label>
                                                <textarea class="form-control @error('address') is-invalid @enderror" type="text"
                                                    value="" name="address" placeholder="Masukkan Alamat">{{$address}}</textarea>
                                                    @error('address')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                                    
                                                @enderror
                                            </div>
                                        </div>
                                        
                                    </div>
                                    <hr class="horizontal dark">
                                    <p class="text-uppercase text-sm">Intern Information</p>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="example-text-input" class="form-control-label">Posisi<span class="text-danger"> *</span></label>
                                                <select class="form-select form-control @error('position_id') is-invalid @enderror" name="position_id">
                                                    <option value="" selected >Pilih Posisi Magang</option>
                                                    @foreach ($positions as $position)
                                                        <option value="{{ $position->id }}" {{ $position_id == $position->id ? 'selected' : '' }}>
                                                            {{ $position->name }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                                @error('position_id')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="example-text-input" class="form-control-label">Tanggal Mulai<span class="text-danger"> *</span></label>
                                                <div class="input-group date" id="datepicker">
                                                    <input type="date" id="start_date" class=" form-control @error('start_date') is-invalid @enderror" id="date" name="start_date" value="{{$start_date}}" />
                                                    @error('start_date')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                                    
                                                @enderror
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="example-text-input" class="form-control-label">Tanggal Selesai<span class="text-danger"> *</span></label>
                                                <div class="input-group date" >
                                                    <input type="date" id="end_date" class="form-control  @error('end_date') is-invalid @enderror" id="date" name="end_date" value="{{$end_date}}" />
                                                    @error('end_date')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                                    
                                                @enderror
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <hr class="horizontal dark">
                                    <p class="text-uppercase text-sm">File Information</p>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="fileCV" class="form-control-label">CV<span class="text-danger"> *</span></label>
                                                <div class="custom-file">
                                                    <input class="custom-file-input @error('cv') is-invalid @enderror" type="file" id="fileCV" name="cv" accept=".pdf, .docx, .png">
                                                    <label class="custom-file-label" for="fileCV">Choose file</label>
                                                </div>
                                                
                                                @if ($cvUrl)
                                                <a href="{{ $cvUrl }}" target="_blank" class="text-sm text-primary">Lihat CV</a>
                                                {{-- <a class="text-sm text-primary view-cv" data-fancybox data-type="iframe" data-src="{{ $cvUrl }}" href="javascript:;">Lihat CV</a> --}}

                                                @else
                                                    <p class="tetx-sm text-danger">Belum ada CV</p>
                                                @endif 
                                                @error('cv')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="fileMotivation" class="form-control-label">Motivation Letter<span class="text-danger"> *</span></label>
                                                <div class="custom-file">
                                                    <input class="custom-file-input @error('motivation_letter') is-invalid @enderror" type="file" id="fileMotivation" name="motivation_letter" accept=".pdf, .docx, .png">
                                                    <label class="custom-file-label" for="fileCV">Choose file</label>
                                                </div>
                                                @if ($motivationLetterUrl)
                                                <a href="{{ $motivationLetterUrl }}" target="_blank" class="text-sm text-primary">Lihat Motivation Letter</a>
                                                @else
                                                    <p class="tetx-sm text-danger">Belum ada Motivation Letter</p>
                                                @endif 
                                                @error('motivation_letter')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="fileSurat" class="form-control-label">Surat Pengantar</label>
                                                <div class="custom-file">
                                                    <input class="custom-file-input @error('cover_letter') is-invalid @enderror" type="file" id="fileSurat" name="cover_letter" accept=".pdf, .docx, .png">
                                                    <label class="custom-file-label" for="fileSurat">Choose file</label>
                                                </div>
                                                
                                                @if ($coverLetterUrl)
                                                <a href="{{ $coverLetterUrl }}" target="_blank" class="text-sm text-primary">Lihat Surat Pengantar</a>
                                            @else
                                                <p class="text-sm text-danger">Belum ada Surat Pengantar</p>
                                            @endif  
                                                @error('cover_letter')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="fileSurat" class="form-control-label">Portfolio</label>
                                                <div class="custom-file">
                                                    <input class="custom-file-input @error('portfolio') is-invalid @enderror" type="file" id="filePortfolio" name="portfolio" accept=".pdf, .docx, .png">
                                                    <label class="custom-file-label" for="fileSurat">Choose file</label>
                                                </div>
                                                
                                                @if ($portfolioUrl)
                                                <a href="{{ $portfolioUrl }}" target="_blank" class="text-sm text-primary">Lihat Portfolio</a>
                                                @else
                                                    <p>Belum ada Motivation Letter</p>
                                                @endif  
                                                @error('portfolio')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="filefoto" class="form-control-label">Pas Foto<span class="text-danger"> *</span></label>
                                                <div class="custom-file">
                                                    <input class="custom-file-input @error('photo') is-invalid @enderror" type="file" id="filefoto" name="photo" accept=".jpg, .jpeg, .png, .webp">
                                                    <label class="custom-file-label" for="fileSurat">Choose file</label>
                                                </div>
                                                
                                                @if ($photoUrl)
                                                <a data-fancybox="photo-preview" href="{{ $photoUrl }}">
                                                    {{-- <img src="{{ $photoUrl }}" alt="Preview Foto" width="200" class="mt-3"> --}}Lihat Foto
                                                </a>
                                                @else
                                                    <p>Belum ada Foto</p>
                                                @endif  
                                                @error('photo')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                        <p class="text-uppercase text-sm">Status Information</p>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="example-text-input" class="form-control-label">Status<span class="text-danger"> *</span></label>
                                                
                                                <select class="form-select form-control @error('status') is-invalid @enderror" name="status"  {{ $statusChanged ? 'disabled' : '' }}>
                                                    <option value="" selected disabled>Pilih Status</option>
                                                    @foreach ($st as $key => $value)
                                                        <option value="{{ $key }}" {{ $intern->status == $key ? 'selected' : '' }}>
                                                            {{ $value }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                                
                                                
                                                
                                                @error('status')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                                    
                                                @enderror
                                            </div>
                                        </div>
                                            
                                    </div>
                                    <div class="inline-block mt-3">
                                        <button type="" class="btn btn-md btn-success">Update</button>
                                        <button type="button" class="btn btn-md btn-secondary" onclick="window.history.back();">Cancel</button>
        
                                    </div>
                                   
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
            </div>

          </div>
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
@endsection