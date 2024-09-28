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
                <h3>Edit Periode</h3>
                <p class="text-subtitle text-muted">Masukkan data yang ingin diubah Informasi Periode</p>
            </div>
            <div class="col-12 col-md-6 order-md-2 order-first">
                <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ url('admin/dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('periode.index') }}">Periode</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Edit Periode</li>
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
                        <form action="{{ route('periode.update', $periode->id) }}" enctype="multipart/form-data"
                            id="formEditPeriode">
                            @csrf
                            @method('PUT')
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
                                                                    type="text" value="{{ old('name', $periode->name) }}"
                                                                    name="name" placeholder="Masukkan Nama">
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
                                                                        placeholder="Pilih Tanggal Mulai" id="start_date"
                                                                        value="{{ old('start_date', $periode->start_date) }}">
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
                                                                        placeholder="Pilih Tanggal Selesai" id="end_date"
                                                                        value="{{ old('end_date', $periode->end_date) }}">

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
                                                                    name="description" placeholder="Masukkan Deskripsi">{{ old('description', $periode->description) }}</textarea>
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
                                            @foreach ($periode->positions as $index => $position)
                                                <div class="row position-row" data-index="{{ $index }}">
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label class="form-control-label">Posisi <span
                                                                    class="text-danger">*</span></label>
                                                            <select
                                                                class="form-select form-control position-select mt-2 @error('positions.' . $index . '.id') is-invalid @enderror"
                                                                name="positions[{{ $index }}][id]" required>
                                                                <option value="" disabled>Pilih Posisi Magang</option>
                                                                @foreach ($positions as $pos)
                                                                    <option value="{{ $pos->id }}"
                                                                        {{ old('positions.' . $index . '.id', $position->pivot->position_id) == $pos->id ? 'selected' : '' }}>
                                                                        {{ $pos->name }}
                                                                    </option>
                                                                @endforeach
                                                            </select>
                                                            @error('positions.' . $index . '.id')
                                                                <div class="invalid-feedback">{{ $message }}</div>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <div class="form-group">
                                                            <label class="form-control-label">Kuota Pemagang<span
                                                                    class="text-danger"> *</span></label>
                                                            <input
                                                                class="form-control mt-2 @error('positions.' . $index . '.quota') is-invalid @enderror"
                                                                type="number"
                                                                name="positions[{{ $index }}][quota]"
                                                                value="{{ old('positions.' . $index . '.quota', $position->pivot->quota) }}"
                                                                placeholder="Masukkan Jumlah Kuota" required>
                                                            @error('positions.' . $index . '.quota')
                                                                <div class="invalid-feedback">{{ $message }}</div>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    @if ($index == 0)
                                                        <div
                                                            class="col-md-1 align-content-center text-center justify-items-center">
                                                            <button class="btn btn-primary align-self-center mt-3"
                                                                type="button" id="add">+</button>
                                                        </div>
                                                    @else
                                                        <div
                                                            class="col-md-1 align-content-center text-center justify-items-center">
                                                            <button type="button"
                                                                class="btn btn-danger remove-button mt-3">-</button>
                                                        </div>
                                                    @endif
                                                </div>
                                            @endforeach
                                        </div>


                                        <div class="inline-block mt-3">
                                            <a type="button" class="btn btn-md btn-light-secondary"
                                                href="{{ route('periode.index') }}">Cancel</a>
                                            <button type="submit" class="btn btn-md btn-primary"
                                                id="submitButton">Update</button>
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

        document.getElementById('add').addEventListener('click', addPositionRow);
        document.getElementById('positions-container').addEventListener('change', handlePositionChange);
        document.getElementById('positions-container').addEventListener('click', function(event) {
            if (event.target.classList.contains('remove-button')) {
                handleRemovePosition(event);
            }
        });
        document.getElementById('submit-button').addEventListener('click', handleSubmit);

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
            <button type="button" class="btn btn-danger mt-3 remove-button">-</button>
        </div>
    `;
            return row;
        }

        function handleRemovePosition(event) {
            const row = event.target.closest('.position-row');
            row.remove();
            updateIndices();
        }

        function updateIndices() {
            const rows = document.querySelectorAll('.position-row');
            rows.forEach((row, index) => {
                row.setAttribute('data-index', index);
                const select = row.querySelector('.position-select');
                const input = row.querySelector('input[name^="positions"]');
                select.name = `positions[${index}][id]`;
                input.name = `positions[${index}][quota]`;
            });
            positionCount = rows.length;
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
            $("#formEditPeriode").on("submit", function(e) {
                e.preventDefault();

                var periodeId = "{{ $periode->id }}";

                Swal.fire({
                    title: 'Mohon Tunggu!',
                    html: 'Sedang memproses data...',
                    allowOutsideClick: false,
                    showConfirmButton: false,
                    willOpen: () => {
                        Swal.showLoading();
                    },
                });

                var formData = new FormData(this);

                const positionsData = [];
                $('.position-row').each(function() {
                    const positionId = $(this).find('.position-select').val();
                    const quota = $(this).find('input[name^="positions"]').val();
                    if (positionId) {
                        positionsData.push({
                            id: positionId,
                            quota: quota
                        });
                    }
                });

                formData.append('positions', JSON.stringify(positionsData));

                $.ajax({
                    type: 'POST',
                    url: '{{ route('periode.update', ['periode' => ':periodeId']) }}'.replace(
                        ':periodeId', periodeId),
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function(response) {
                        console.log(response);

                        Swal.close();

                        if (response.success) {
                            Swal.fire({
                                icon: 'success',
                                title: 'Berhasil!',
                                text: 'Data berhasil diupdate.',
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
                                    text: 'Terjadi kesalahan saat memperbarui data.',
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
                                text: 'Terjadi kesalahan saat memperbarui data.',
                                confirmButtonColor: "#435EBE",
                            });
                        }
                    },
                });
            });
        });
    </script>
@endsection
