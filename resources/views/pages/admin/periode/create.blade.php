@extends('layouts.app')

@section('content')
    <header class="mb-3">
        <a href="#" class="burger-btn d-block d-xl-none">
            <i class="bi bi-justify fs-3"></i>
        </a>
    </header>
    <div class="page-title">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h3>Tambah Periode</h3>
                <p class="text-subtitle text-muted">Masukkan data dengan benar untuk menambahkan Periode</p>
            </div>
            <div class="col-12 col-md-6 order-md-2 order-first">
                <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ url('admin/dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('periode.index') }}">Periode</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Tambah Periode</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
    <div class="content-wrapper">

        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">

                </div>
            </div><!-- /.container-fluid -->
        </section>

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <!-- left column -->
                    <div class="col-md-12">
                        <form method="POST" action="{{ route('periode.store') }}" enctype="multipart/form-data"
                            id="formPeriode">
                            @csrf
                            <div class="card card-primary">
                                <div class="">
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="card">
                                                <div class="card-body mt-2">
                                                    <p class="text-uppercase text-sm">Periode Information</p>
                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            <div class="form-group">
                                                                <label for="example-text-input"
                                                                    class="form-control-label">Nama<span
                                                                        class="text-danger"> *</span></label>
                                                                <input
                                                                    class="form-control  @error('name') is-invalid @enderror"
                                                                    type="text" value="" name="name"
                                                                    placeholder="Masukkan Nama">
                                                                @error('name')
                                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                                @enderror
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label for="example-text-input"
                                                                    class="form-control-label">Tanggal Mulai<span
                                                                        class="text-danger"> *</span></label>
                                                                <div class="input-group date" id="datepicker">
                                                                    <input type="date" name="start_date"
                                                                        class="form-control  flatpickr-no-config @error('start_date') is-invalid @enderror"
                                                                        placeholder="Pilih Tanggal Mulai" id="start_date">
                                                                    @error('start_date')
                                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                                    @enderror
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label for="example-text-input"
                                                                    class="form-control-label">Tanggal Selesai<span
                                                                        class="text-danger"> *</span></label>
                                                                <div class="input-group date">
                                                                    <input type="date" name="end_date"
                                                                        class="form-control flatpickr-no-config @error('end_date') is-invalid @enderror"
                                                                        placeholder="Pilih Tanggal Selesai" id="end_date">

                                                                    @error('end_date')
                                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                                    @enderror
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-12">
                                                            <div class="form-group">
                                                                <label for="example-text-input"
                                                                    class="form-control-label">Deskripsi</label>
                                                                <textarea class="form-control  @error('description') is-invalid @enderror" type="text" value=""
                                                                    name="description" placeholder="Masukkan Deskripsi"></textarea>
                                                                @error('description')
                                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                                @enderror
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card card-primary">
                                <div class="card">
                                    <div class="card-body">
                                        <p class="text-uppercase text-sm">Position Information</p>
                                        <div id="positions-container">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="example-text-input" class="form-control-label">Posisi
                                                            <span class="text-danger">*</span></label>
                                                        <select
                                                            class="form-select form-control position-select mt-2 @error('position_id') is-invalid @enderror"
                                                            name="positions[0][id]" data-selected="" required>
                                                            <option value="" selected disabled>Pilih Posisi Magang
                                                            </option>
                                                            @foreach ($positions as $position)
                                                                <option value="{{ $position->id }}"
                                                                    {{ old('position_id') == $position->id ? 'selected' : '' }}>
                                                                    {{ $position->name }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="form-group">
                                                        <label for="example-text-input" class="form-control-label">Kuota
                                                            Pemagang<span class="text-danger"> *</span></label>
                                                        <input
                                                            class="form-control mt-2  @error('positions.0.quota') is-invalid @enderror"
                                                            type="number" name="positions[0][quota]"
                                                            placeholder="Masukkan Jumlah Kuota" required>
                                                        @error('positions.0.quota')
                                                            <div class="invalid-feedback">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div
                                                    class="col-md-1 align-content-center text-center justify-items-center">
                                                    <button class="btn btn-primary align-self-center mt-3" type="button"
                                                        id="add">+</button>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="inline-block mt-3">
                                            <a type="button" class="btn btn-md btn-light-secondary"
                                                href="{{ route('periode.index') }}">Cancel</a>
                                            <button type="submit" class="btn btn-md btn-primary"
                                                id="submitButton">Simpan</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </section>
    </div>

    <script>
        let positionCount = 1;
        let selectedPositions = [];

        document.getElementById('add').addEventListener('click', addPositionRow);
        document.getElementById('positions-container').addEventListener('change', handlePositionChange);
        document.getElementById('positions-container').addEventListener('click', handleRemovePosition);


        function addPositionRow() {
            const container = document.getElementById('positions-container');
            const newRow = createPositionRow(positionCount);
            container.appendChild(newRow);
            positionCount++;
        }

        function createPositionRow(index) {
            const row = document.createElement('div');
            row.classList.add('row', 'position-row');
            row.setAttribute('data-index', index);
            row.innerHTML = `
            <div class="col-md-6">
                <div class="form-group">
                    <label for="example-text-input" class="form-control-label">Posisi</label>
                    <select class="form-select form-control mt-2 position-select" name="positions[${index}][id]">
                        <option value="" selected disabled>Pilih Posisi Magang</option>
                        @foreach ($positions as $position)
                            <option value="{{ $position->id }}">{{ $position->name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    <label for="example-text-input" class="form-control-label">Kuota Pemagang<span class="text-danger"> *</span></label>
                    <input class="form-control mt-2" type="number" name="positions[${index}][quota]" placeholder="Masukkan Jumlah Kuota" required>
                </div>
            </div>
            <div class="col-md-1 align-content-center text-center justify-items-center">
                    <button type="button" class="btn btn-danger remove-button mt-3">-</button>
            </div>
        `;
            return row;
        }


        function handleRemovePosition(event) {
            if (event.target.classList.contains('remove-button')) {
                event.target.closest('.position-row').remove();
            }
        }

        function handlePositionChange(event) {
            const selectedValue = event.target.value;
            if (!selectedValue) return;

            const allSelectedPositions = Array.from(document.querySelectorAll('.position-select'))
                .map(select => select.value)
                .filter(value => value);

            const duplicates = allSelectedPositions.filter((item, index) => allSelectedPositions.indexOf(item) !== index);

            if (duplicates.includes(selectedValue)) {
                Swal.fire({
                    icon: 'warning',
                    title: 'Posisi Sudah Dipilih',
                    text: 'Silakan pilih posisi lain.',
                    showCancelButton: true,
                    confirmButtonText: 'Ya',
                    cancelButtonText: 'Batal',
                    confirmButtonColor: "#435EBE",
                    cancelButtonColor: "#CDD3D8",
                });
                resetSelectedPosition(event.target);
            }
        }

        function resetSelectedPosition(selectElement) {
            selectElement.value = '';
        }
    </script>

    <script>
        $(document).ready(function() {
            $("#formPeriode").on("submit", function(e) {
                e.preventDefault();

                Swal.fire({
                    title: 'Mohon Tunggu!',
                    html: 'Sedang memproses data...',
                    allowOutsideClick: false,
                    showConfirmButton: false,
                    willOpen: () => {
                        Swal.showLoading();
                    },
                });

                $.ajax({
                    type: 'POST',
                    url: '{{ route('periode.store') }}',
                    data: new FormData(this),
                    processData: false,
                    contentType: false,
                    success: function(response) {
                        Swal.close();

                        if (response.success) {
                            Swal.fire({
                                icon: 'success',
                                title: 'Berhasil!',
                                text: 'Data berhasil disimpan.',
                                confirmButtonColor: "#435EBE",
                                cancelButtonColor: "#CDD3D8",
                            }).then(function() {
                                window.location.href = '{{ route('periode.index') }}';
                            });
                        } else {
                            if (response.errors) {
                                var errorMessages = '';
                                for (var key in response.errors) {
                                    if (response.errors.hasOwnProperty(key)) {
                                        errorMessages += response.errors[key][0] + '<br>';
                                    }
                                }
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Oops...',
                                    html: errorMessages,
                                    confirmButtonColor: "#435EBE",
                                });
                            } else {
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Oops...',
                                    text: 'Terjadi kesalahan saat menyimpan data.',
                                    confirmButtonColor: "#435EBE",
                                });
                            }
                        }
                    },
                    error: function(xhr) {
                        Swal.close();
                        if (xhr.status === 422) {
                            var errorMessages = '';
                            var errors = xhr.responseJSON.errors;
                            for (var key in errors) {
                                if (errors.hasOwnProperty(key)) {
                                    errorMessages += errors[key][0] + '<br>';
                                }
                            }
                            Swal.fire({
                                icon: 'error',
                                title: 'Oops...',
                                html: errorMessages,
                                confirmButtonColor: "#435EBE",
                            });
                        } else {
                            Swal.fire({
                                icon: 'error',
                                title: 'Oops...',
                                text: 'Terjadi kesalahan saat menyimpan data.',
                                confirmButtonColor: "#435EBE",
                            });
                        }
                    },
                });
            });
        });
    </script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var startDateInput = document.getElementById('start_date');
            var endDateInput = document.getElementById('end_date');

            var today = new Date();
            today.setHours(0, 0, 0, 0);

            endDateInput.addEventListener('change', function() {
                var startDate = new Date(startDateInput.value);
                var endDate = new Date(endDateInput.value);

                if (startDate > endDate) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Oopss...',
                        text: 'Tanggal selesai harus setelah tanggal mulai',
                        confirmButtonText: 'Ok',
                        confirmButtonColor: "#435EBE",
                        cancelButtonColor: "#CDD3D8",
                    });

                    endDateInput.value = '';
                } else if (endDate < today) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Oopss...',
                        text: 'Tanggal selesai tidak boleh kurang dari tanggal hari Ini',
                        confirmButtonText: 'Ok',
                        confirmButtonColor: "#435EBE",
                        cancelButtonColor: "#CDD3D8",
                    });

                    endDateInput.value = '';
                }
            });

            startDateInput.addEventListener('change', function() {
                var startDate = new Date(startDateInput.value);

                if (startDate < today) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Oopss...',
                        text: 'Tanggal mulai tidak boleh kurang dari tanggal hari Ini',
                        confirmButtonText: 'Ok',
                        confirmButtonColor: "#435EBE",
                        cancelButtonColor: "#CDD3D8",
                    });

                    startDateInput.value = '';
                }
            });
        });
    </script>
@endsection
