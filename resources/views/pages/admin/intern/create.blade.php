@extends('layouts.app')

@section('content')
<div class="content-wrapper">
    
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Tambah pemagang</h1>
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
                <h3 class="card-title">Form Tambah Pemagang</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form method="POST" action="{{route ('intern.store')}}" enctype="multipart/form-data">
                @csrf
                <div class="">
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-body">
                                    <p class="text-uppercase text-sm">User Information</p>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="example-text-input" class="form-control-label">Email address<span class="text-danger"> *</span></label>
                                                <input class="form-control @error('email') is-invalid @enderror" type="email" value="" name="email" placeholder="Masukkan Email">
                                                @error('email')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                                    
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="example-text-input" class="form-control-label">Nama Lengkap<span class="text-danger"> *</span></label>
                                                <input class="form-control  @error('full_name') is-invalid @enderror" type="text" value="" name="full_name" placeholder="Masukkan Nama Lengkap">
                                                @error('full_name')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                                    
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="example-text-input" class="form-control-label">Nama Panggilan<span class="text-danger"> *</span></label>
                                                <input class="form-control  @error('username') is-invalid @enderror" type="text" value="" name="username" placeholder="Masukkan Nama Panggilan">
                                                @error('username')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                                    
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="example-text-input" class="form-control-label">No Telephone<span class="text-danger"> *</span></label>
                                                <input class="form-control @error('phone_number') is-invalid @enderror" type="number" value="" name="phone_number" placeholder="Masukkan Telp">
                                                @error('phone_number')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                                    
                                                @enderror
                                            </div>  
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="example-text-input" class="form-control-label">Jenis Kelamin<span class="text-danger"> *</span></label>
                                                
                                                <select class="form-select form-control @error('gender') is-invalid @enderror" name="gender"> 
                                                    <option value="" selected disabled>Pilih Jenis Kelamin</option>
                                                    <option value="L" {{ old('gender') == 'L' ? 'selected' : '' }}>Laki - Laki</option>
                                                    <option value="P" {{ old('gender') == 'P' ? 'selected' : '' }}>Perempuan</option>
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
                                                <input class="form-control @error('school') is-invalid @enderror" type="text" value="" name="school" placeholder="Masukkan Asal Sekolah">
                                                @error('school')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                                    
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="example-text-input" class="form-control-label">Jurusan / Prodi<span class="text-danger"> *</span></label>
                                                <input class="form-control @error('major') is-invalid @enderror" type="text" value="" name="major" placeholder="Masukkan Jurusan">
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
                                                    value="" name="address" placeholder="Masukkan Alamat"></textarea>
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
                                                <select class="form-select form-control @error('position_id') is-invalid @enderror" name="position_id"> <!-- Ubah 'position' menjadi 'position_id' -->
                                                    <option value="" selected disabled>Pilih Posisi Magang</option>
                                                    @foreach ($position as $position)
                                                        <option value="{{ $position->id }}" {{ old('position_id') == $position->id ? 'selected' : '' }}>{{ $position->name }}</option>
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
                                                    <input type="date" id="start_date" class=" form-control @error('start_date') is-invalid @enderror" id="date" name="start_date"/>
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
                                                    <input type="date" id="end_date" class="form-control  @error('end_date') is-invalid @enderror" id="date" name="end_date"/>
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
                                                @error('cover_letter')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="fileSurat" class="form-control-label">Portfolio<span class="text-danger"> *</span></label>
                                                <div class="custom-file">
                                                    <input class="custom-file-input @error('portfolio') is-invalid @enderror" type="file" id="filePortfolio" name="portfolio" accept=".pdf, .docx, .png">
                                                    <label class="custom-file-label" for="fileSurat">Choose file</label>
                                                </div>
                                                @error('portfolio')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="filefoto" class="form-control-label">Pas Foto<span class="text-danger"> *</span></label>
                                                <div class="custom-file">
                                                    <input class="custom-file-input @error('photo') is-invalid @enderror" type="file" id="filefoto" name="photo" accept=".pdf, .docx, .png">
                                                    <label class="custom-file-label" for="fileSurat">Choose file</label>
                                                </div>
                                                @error('photo')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                            <div class="form-group">
                                                <input class="form-control invisible" value="pending" id="status" name="status">
                                                
                                            </div>
                                    </div>
                                    <div class="inline-block mt-3">
                                        <button type="submit" class="btn btn-md btn-success">Simpan</button>
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