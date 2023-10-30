@extends('layouts.app')

@section('content')
    <div class="content-wrapper">

        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Detail pemagang</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Master Data</a></li>
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
                                <h3 class="card-title">Form Detail Pemagang</h3>
                            </div>
                            <!-- /.card-header -->
                            <!-- form start -->
                            <form method="POST" action="{{ route('intern.show', $id) }}" enctype="multipart/form-data">
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
                                                            <div class="form-group">
                                                                <label for="example-text-input"
                                                                    class="form-control-label">Email address</label>
                                                                <input
                                                                    class="form-control @error('email') is-invalid @enderror"
                                                                    type="email" value="{{ $email }}"
                                                                    name="email" placeholder="Masukkan Email" disabled>
                                                                @error('email')
                                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                                @enderror
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label for="example-text-input"
                                                                    class="form-control-label">Nama Lengkap</label>
                                                                <input
                                                                    class="form-control  @error('full_name') is-invalid @enderror"
                                                                    type="text" value="{{ $full_name }}"
                                                                    name="full_name" placeholder="Masukkan Nama Lengkap"
                                                                    disabled>
                                                                @error('full_name')
                                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                                @enderror
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label for="example-text-input"
                                                                    class="form-control-label">Nama Panggilan</label>
                                                                <input
                                                                    class="form-control  @error('username') is-invalid @enderror"
                                                                    type="text" value="{{ $username }}"
                                                                    name="username" placeholder="Masukkan Nama Panggilan"
                                                                    disabled>
                                                                @error('username')
                                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                                @enderror
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label for="example-text-input"
                                                                    class="form-control-label">No Telephone</label>
                                                                <input
                                                                    class="form-control @error('phone_number') is-invalid @enderror"
                                                                    type="number" value="{{ $phone_number }}"
                                                                    name="phone_number" placeholder="Masukkan Telp"
                                                                    disabled>
                                                                @error('phone_number')
                                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                                @enderror
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label for="example-text-input"
                                                                    class="form-control-label">Jenis Kelamin</label>

                                                                <select
                                                                    class="form-select form-control @error('gender') is-invalid @enderror"
                                                                    name="gender" disabled>
                                                                    <option value="" selected>Pilih Jenis Kelamin
                                                                    </option>
                                                                    @foreach ($genders as $key => $value)
                                                                        <option value="{{ $key }}"
                                                                            {{ $gender == $key ? 'selected' : '' }}>
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
                                                                <label for="example-text-input"
                                                                    class="form-control-label">Asal Sekolah</label>
                                                                <input
                                                                    class="form-control @error('school') is-invalid @enderror"
                                                                    type="text" value="{{ $school }}"
                                                                    name="school" placeholder="Masukkan Asal Sekolah"
                                                                    disabled>
                                                                @error('school')
                                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                                @enderror
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label for="example-text-input"
                                                                    class="form-control-label">Jurusan / Prodi</label>
                                                                <input
                                                                    class="form-control @error('major') is-invalid @enderror"
                                                                    type="text" value="{{ $major }}"
                                                                    name="major" placeholder="Masukkan Jurusan" disabled>
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
                                                                <label for="example-text-input"
                                                                    class="form-control-label">Alamat</label>
                                                                <textarea class="form-control @error('address') is-invalid @enderror" type="text" value="{{ $address }}"
                                                                    name="address" placeholder="Masukkan Alamat" disabled>{{ $address }}</textarea>
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
                                                                <label for="example-text-input"
                                                                    class="form-control-label">Posisi</label>
                                                                <select
                                                                    class="form-select form-control @error('position_id') is-invalid @enderror"
                                                                    name="position_id" disabled>
                                                                    <option value="" selected disabled>Pilih Posisi
                                                                        Magang</option>
                                                                    @foreach ($positions as $position)
                                                                        <option value="{{ $position->id }}"
                                                                            {{ $position_id == $position->id ? 'selected' : '' }}>
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
                                                                <label for="example-text-input"
                                                                    class="form-control-label">Tanggal Mulai</label>
                                                                <div class="input-group date" id="datepicker">
                                                                    <input type="date" id="start_date"
                                                                        class=" form-control @error('start_date') is-invalid @enderror"
                                                                        id="date" name="start_date"
                                                                        value="{{ $start_date }}" disabled />
                                                                    @error('start_date')
                                                                        <div class="invalid-feedback">{{ $message }}
                                                                        </div>
                                                                    @enderror
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label for="example-text-input"
                                                                    class="form-control-label">Tanggal Selesai</label>
                                                                <div class="input-group date">
                                                                    <input type="date" id="end_date"
                                                                        class="form-control  @error('end_date') is-invalid @enderror"
                                                                        id="date" name="end_date"
                                                                        value="{{ $end_date }}" disabled />
                                                                    @error('end_date')
                                                                        <div class="invalid-feedback">{{ $message }}
                                                                        </div>
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
                                                                <label for="fileCV"
                                                                    class="form-control-label">CV</label>
                                                                <div class="custom-file">
                                                                    <input
                                                                        class="custom-file-input @error('cv') is-invalid @enderror"
                                                                        type="file" id="fileCV" name="cv"
                                                                        accept=".pdf, .docx, .png" disabled>
                                                                    <label class="custom-file-label" for="fileCV">Choose
                                                                        file</label>
                                                                </div>

                                                                @if ($cvUrl)
                                                                
                                                                    @if ($cvExtension == 'pdf' || $cvExtension == 'docx')
                                                                        <a class="btn mt-2" id="cv-link" data-toggle="modal" data-target="#cvModal"
                                                                            {{-- href="/public/files/cv/DUMMY DOCUMENT TEST.pdf" --}}
                                                                            data-caption="CV {{ $full_name }}"
                                                                            class="text-sm text-primary"
                                                                            style="background-color: #7066e0"
                                                                            data-toggle="tooltip" data-placement="top"
                                                                            title="Lihat CV">
                                                                            <li class="fas fa-eye text-white"></li>
                                                                        </a>
                                                                    @endif
                                                                    <a class="btn btn-info mt-2"
                                                                        href="{{ $cvUrl }}" download
                                                                        data-toggle="tooltip" data-placement="top"
                                                                        title="Unduh CV">
                                                                        <li class="fas fa-download"></li>
                                                                    </a>
                                                                    @if ($cvExtension == 'png')
                                                                    <div class="mt-3">
                                                                        <a data-fancybox data-caption="CV {{$full_name}}"
                                                                            href="{{ $cvUrl }}">
                                                                            <img src="{{ $cvUrl }}" class="mt-3"
                                                                                alt="CV" width="200">
                                                                        </a>
                                                                    </div>
                                                                    @endif
                                                                @else
                                                                    <p class="text-sm text-danger">Belum ada CV</p>
                                                                @endif
                                                                @error('cv')
                                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                                @enderror
                                                                <div class="modal fade" id="cvModal" tabindex="-1" role="dialog" aria-labelledby="cvModalLabel" aria-hidden="true">
                                                                    <div class="modal-dialog modal-lg" role="document">
                                                                        <div class="modal-content">
                                                                            <div class="modal-header">
                                                                                <h5 class="modal-title" id="cvModalLabel">CV {{ $full_name }}</h5>
                                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                                    <span aria-hidden="true">&times;</span>
                                                                                </button>
                                                                            </div>
                                                                            <div class="modal-body">
                                                                                @if ($cvExtension == 'pdf')
                                                                                    <object data="{{ $cvUrl }}" type="application/pdf" width="100%" height="600px">
                                                                                        <p>Unable to display PDF file. <a href="{{ $cvUrl }}" target="_blank">Download</a> instead.</p>
                                                                                    </object>
                                                                               
                                                                                @elseif ($cvExtension == 'docx')
                                                                                    <!-- Tampilkan sesuai dengan format DOCX, misalnya dengan iframe -->
                                                                                    <iframe src="{{ $cvUrl }}" width="100%" height="600px" frameborder="0"></iframe>
                                                                                @else
                                                                                    <p>File format not supported. <a href="{{ $cvUrl }}" target="_blank">Download</a> instead.</p>
                                                                                @endif
                                                                            </div>
                                                                            
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label for="fileMotivation"
                                                                    class="form-control-label">Motivation Letter</label>
                                                                <div class="custom-file">
                                                                    <input
                                                                        class="custom-file-input @error('motivation_letter') is-invalid @enderror"
                                                                        type="file" id="fileMotivation"
                                                                        name="motivation_letter"
                                                                        accept=".pdf, .docx, .png" disabled>
                                                                    <label class="custom-file-label" for="fileCV">Choose
                                                                        file</label>
                                                                </div>
                                                                @if ($motivationLetterUrl)
                                                                    <a class="btn mt-2" href="{{ $motivationLetterUrl }}"
                                                                        class="text-sm text-primary"
                                                                        style="background-color: #7066e0"
                                                                        data-toggle="tooltip" data-placement="top"
                                                                        title="Lihat Motivation Letter">
                                                                        <li class="fas fa-eye text-white"></li>
                                                                    </a>
                                                                    <a class="btn btn-info mt-2"
                                                                        href="{{ $motivationLetterUrl }}" download
                                                                        data-toggle="tooltip" data-placement="top"
                                                                        title="Unduh Motivation Letter">
                                                                        <li class="fas fa-download"></li>
                                                                    </a>
                                                                @else
                                                                    <p class="tetx-sm text-danger">Belum ada Motivation
                                                                        Letter</p>
                                                                @endif
                                                                @error('motivation_letter')
                                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                                @enderror
                                                                {{-- <iframe src="('https://view.officeapps.live.com/op/embed.aspx?src=/public/files/motivation_letter/Motivation Letter - Thoriq Muhammad Hanif Raihan.docx')" width="100%" height="565px" frameborder="0"></iframe> --}}
                                                                {{-- <iframe src='https://view.officeapps.live.com/op/embed.aspx?src=http://www.learningaboutelectronics.com/Articles/NP-modernization-act-new-york-state.doc' width='80%' height='565px' frameborder='0'> </iframe>
                                                                <iframe src='https://view.officeapps.live.com/op/embed.aspx?src={{ asset('public/files/motivation_letter/thrq.docx') }}' width='100%' height='565px' frameborder='0' class="mt-2"></iframe> --}}

                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label for="fileSurat" class="form-control-label">Surat
                                                                    Pengantar</label>
                                                                <div class="custom-file">
                                                                    <input
                                                                        class="custom-file-input @error('cover_letter') is-invalid @enderror"
                                                                        type="file" id="fileSurat" name="cover_letter"
                                                                        accept=".pdf, .docx, .png" disabled>
                                                                    <label class="custom-file-label"
                                                                        for="fileSurat">Choose file</label>
                                                                </div>

                                                                @if ($coverLetterUrl)
                                                                    <a href="{{ $coverLetterUrl }}" target="_blank"
                                                                        class="text-sm text-primary btn mt-2"
                                                                        style="background-color: #7066e0" 
                                                                        data-toggle="tooltip" data-placement="top"
                                                                        title="Lihat Surat Pengantar">
                                                                        <li class="fas fa-eye text-white"></li>
                                                                    </a>
                                                                    <a class="btn btn-info mt-2"
                                                                        href="{{ $coverLetterUrl }}" download
                                                                        data-toggle="tooltip" data-placement="top"
                                                                        title="Unduh Surat Pengantar">
                                                                        <li class="fas fa-download"></li>
                                                                    </a>
                                                                @else
                                                                    <p class="text-sm text-danger">Belum ada Surat
                                                                        Pengantar</p>
                                                                @endif
                                                                @error('cover_letter')
                                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                                @enderror
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label for="fileSurat"
                                                                    class="form-control-label">Portfolio</label>
                                                                <div class="custom-file">
                                                                    <input
                                                                        class="custom-file-input @error('portfolio') is-invalid @enderror"
                                                                        type="file" id="filePortfolio"
                                                                        name="portfolio" accept=".pdf, .docx, .png"
                                                                        disabled>
                                                                    <label class="custom-file-label"
                                                                        for="fileSurat">Choose file</label>
                                                                </div>

                                                                @if ($portfolioUrl)
                                                                    <a href="{{ $portfolioUrl }}" target="_blank"
                                                                        class="text-sm text-primary btn mt-2"
                                                                        style="background-color: #7066e0"
                                                                        data-toggle="tooltip" data-placement="top"
                                                                        title="Lihat Portfolio">
                                                                        <li class="fas fa-eye text-white" > </li>
                                                                    </a>
                                                                    <a class="btn btn-info mt-2"
                                                                        href="{{ $portfolioUrl }}" download
                                                                        data-toggle="tooltip" data-placement="top"
                                                                        title="Unduh Portfolio">
                                                                        <li class="fas fa-download text-sm"></li>
                                                                    </a>
                                                                @else
                                                                    <p class="text-sm text-danger">Belum ada Portfolio</p>
                                                                @endif
                                                                @error('portfolio')
                                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                                @enderror
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label for="filefoto" class="form-control-label">Pas
                                                                    Foto</label>
                                                                <div class="custom-file">
                                                                    <input
                                                                        class="custom-file-input @error('photo') is-invalid @enderror"
                                                                        type="file" id="filefoto" name="photo"
                                                                        accept=".pdf, .docx, .png" disabled>
                                                                    <label class="custom-file-label"
                                                                        for="fileSurat">Choose file</label>
                                                                </div>

                                                                @if ($photoUrl)
                                                                    <a data-fancybox data-caption="Pas Foto"
                                                                        href="{{ $photoUrl }}">
                                                                        <img src="{{ $photoUrl }}" class="mt-3"
                                                                            alt="PAS Foto" width="200">
                                                                    </a>
                                                                @else
                                                                    <p class="text-sm text-danger">Belum ada Foto</p>
                                                                @endif

                                                                @error('photo')
                                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                                @enderror
                                                            </div>
                                                        </div>


                                                    </div>
                                                    <hr class="horizontal dark">
                                                    <p class="text-uppercase text-sm">Status Information</p>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="example-text-input"
                                                                class="form-control-label">Status</label>

                                                            <select
                                                                class="form-select form-control @error('status') is-invalid @enderror"
                                                                name="status" disabled>
                                                                <option value="" selected>Status</option>
                                                                @foreach ($st as $key => $value)
                                                                    <option value="{{ $key }}"
                                                                        {{ $status == $key ? 'selected' : '' }}>
                                                                        {{ $value }}
                                                                    </option>
                                                                @endforeach
                                                            </select>

                                                            @error('status')
                                                                <div class="invalid-feedback">{{ $message }}</div>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    <div class="inline-block mt-3">
                                                        {{-- <button type="" class="btn btn-md btn-success">Update Status</button> --}}
                                                        <button type="button" class="btn btn-md btn-secondary"
                                                            onclick="window.history.back();">Back</button>

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

<script>
    $(document).ready(function() {
        $("[data-fancybox]").fancybox({
            buttons: ["slideShow", "fullScreen", "thumbs", "close"],
        });
    });
</script>
