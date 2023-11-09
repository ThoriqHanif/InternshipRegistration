@extends('layouts.app')

@section('content')
    <div class="content-wrapper">

        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Edit Periode</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Master Data</a></li>
                            <li class="breadcrumb-item active">Periode Management</li>
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
                                <h3 class="card-title">Form Edit Periode</h3>
                            </div>
                            <!-- /.card-header -->
                            <!-- form start -->
                            <form method="POST" action="{{ route('periode.update', $id) }}" enctype="multipart/form-data"
                                id="formEditPeriode">
                                @csrf
                                @method('PUT')
                                <div class="">
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="card">
                                                <div class="card-body">
                                                    <p class="text-uppercase text-sm">Periode Information</p>
                                                    <div class="row">
                                                        <input type="hidden" name="id"
                                                                value="{{ $id }}">
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label for="example-text-input"
                                                                    class="form-control-label">Nama<span
                                                                        class="text-danger"> *</span></label>
                                                                <input
                                                                    class="form-control  @error('name') is-invalid @enderror"
                                                                    type="text" value="{{ $name }}" name="name"
                                                                    placeholder="Masukkan Nama">
                                                                @error('name')
                                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                                @enderror
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label for="example-text-input"
                                                                    class="form-control-label">Posisi<span
                                                                        class="text-danger"> *</span></label>
                                                                <select
                                                                    class="form-select form-control @error('position_id') is-invalid @enderror"
                                                                    name="position_id">
                                                                    <option value="" selected>Pilih Posisi Magang
                                                                    </option>
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
                                                <label for="example-text-input" class="form-control-label">Tanggal Mulai<span class="text-danger" > *</span></label>
                                                <div class="input-group date" id="datepicker">
                                                    <input type="date" id="start_date" class=" form-control @error('start_date') is-invalid @enderror" id="start_date" name="start_date" value="{{$start_date}}"/>
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
                                                    <input type="date" id="end_date" value="{{$end_date}}" class="form-control @error('end_date') is-invalid @enderror" id="end_date" name="end_date"/>
                                                    @error('end_date')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                                    
                                                @enderror
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="example-text-input"
                                                    class="form-control-label">Kuota Pemagang<span
                                                        class="text-danger"> *</span></label>
                                                <input
                                                    class="form-control  @error('quota') is-invalid @enderror"
                                                    type="number" value="{{$quota}}" name="quota"
                                                    placeholder="Masukkan Jumlah Kuota">
                                                @error('quota')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="example-text-input"
                                                    class="form-control-label">Deskripsi</label>
                                                <textarea
                                                    class="form-control  @error('description') is-invalid @enderror"
                                                    type="text" value="" name="description"
                                                    placeholder="Masukkan Deskripsi">{{$description}}</textarea>
                                                @error('description')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                                        

                                                    </div>
                                                    <div class="inline-block mt-3">
                                                        <button type="submit" class="btn btn-md btn-success"
                                                            id="submitButton">Simpan</button>
                                                        <button type="button" class="btn btn-md btn-secondary"
                                                            onclick="window.history.back();">Cancel</button>

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

         <script>
        $(document).ready(function() {
            $("#formEditPeriode").on("submit", function(e) {
                e.preventDefault();

                var periodeId = "{{ $periode->id }}";

                // Tampilkan pesan "loading" saat akan mengirim permintaan AJAX
                Swal.fire({
                    title: 'Mohon Tunggu!',
                    html: 'Sedang memproses data...',
                    allowOutsideClick: false,
                    showConfirmButton: false,
                    willOpen: () => {
                        Swal.showLoading();
                    },
                });

                // Kirim data ke server menggunakan AJAX
                $.ajax({
                    type: 'POST',
                    url: '{{ route('periode.update', ['periode' => ':periodeId']) }}'.replace(
                        ':periodeId', periodeId),
                    data: new FormData(this),
                    processData: false,
                    contentType: false,
                    success: function(response) {
                        // Tutup pesan "loading" saat berhasil
                        Swal.close();

                        if (response.success) {
                            // Redirect ke halaman index dengan pesan "success"
                            Swal.fire({
                                icon: 'success',
                                title: 'Berhasil!',
                                text: 'Data berhasil diupdate.',
                            }).then(function() {
                                // Redirect ke halaman indeks setelah menutup SweetAlert
                                window.location.href = '{{ route('periode.index') }}';
                            });
                        } else {
                            // Jika validasi gagal, tampilkan pesan-pesan kesalahan
                            if (response.errors) {
                                var errorMessages = '';
                                for (var key in response.errors) {
                                    if (response.errors.hasOwnProperty(key)) {
                                        errorMessages += response.errors[key][0] + '<br>';
                                    }
                                }
                                Swal.fire('Gagal', errorMessages, 'error');
                            } else {
                                Swal.fire('Gagal', 'Terjadi kesalahan saat memperbarui data',
                                    'error');
                            }
                        }
                    },
                    error: function(xhr) {
                        Swal.close();
                        if (xhr.status === 422) {
                            // Menampilkan pesan validasi error SweetAlert
                            var errorMessages = '';
                            var errors = xhr.responseJSON.errors;
                            for (var key in errors) {
                                if (errors.hasOwnProperty(key)) {
                                    errorMessages += errors[key][0] + '<br>';
                                }
                            }
                            Swal.fire('Gagal', errorMessages, 'error');
                        } else {
                            Swal.fire('Gagal', 'Terjadi kesalahan saat update data.', 'error');
                        }
                    },
                });
            });
        });
    </script>
@endsection
