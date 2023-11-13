{{-- @include('layouts.header')

<div class="modal fade" id="reportModal" tabindex="-1" role="dialog" aria-labelledby="reportModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="reportModalLabel">Tambah Daily Report</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="POST" id="formEditReport" action="{{ route('reports.update', $id) }}">
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                        <input type="hidden" name="id" value="{{ $id }}">
                        <label for="presence">Tanggal</label>
                        <input type="text" class="form-control" id="date" value="{{ $date }}"
                            name="date" placeholder="Tanggal">
                    </div>
                    <div class="form-group">
                        <label for="presence">Presensi</label>
                        <select class="form-select form-control @error('presence') is-invalid @enderror"
                            name="presence">
                            <option value="" selected disabled>Pilih Presensi
                            </option>
                            <option value="masuk" {{ old('presence') == 'masuk' ? 'selected' : '' }}>Masuk
                            </option>
                            <option value="remote" {{ old('presence') == 'remote' ? 'selected' : '' }}>Remote
                            </option>
                            <option value="libur" {{ old('presence') == 'libur' ? 'selected' : '' }}>Libur
                            </option>
                            <option value="izin" {{ old('presence') == 'izin' ? 'selected' : '' }}>Izin
                            </option>
                        </select>

                        @error('presence')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="attendance_hours">Jam Kehadiran</label>
                        <input type="number" class="form-control @error('attendance_hours') is-invalid @enderror"
                            id="attendance_hours" placeholder="e.g. 8">
                        @error('attendance_hours')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="agency">Instansi</label>
                        <input type="text" class="form-control @error('agency') is-invalid @enderror" id="agency"
                            placeholder="e.g. Kadang Koding">
                        @error('agency')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="project_name">Nama Project</label>
                        <input type="text" class="form-control @error('project_name') is-invalid @enderror"
                            id="project_name" placeholder="e.g. Website Pendaftaran">
                        @error('project_name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="job">Pekerjaan</label>
                        <input type="text" class="form-control @error('job') is-invalid @enderror" id="job"
                            placeholder="e.g. Backend">
                        @error('job')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="description">Keterangan</label>
                        <textarea class="form-control @error('description') is-invalid @enderror" id="description"
                            placeholder="e.g. Mastering Data Intern"></textarea>
                        @error('description')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <!-- tambahkan form element lainnya sesuai kebutuhan -->
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                <button type="button" class="btn btn-success" type="submit" onclick="submitReport()">Simpan</button>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        $("#formEditReport").on("submit", function(e) {
            e.preventDefault();

            var reportsId = "{{ $report->id }}";

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
                url: '{{ route('reports.update', ['reports' => ':reportsId']) }}'.replace(
                    ':reportsId', reportsId),
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
                            text: 'Report berhasil diupdate.',
                        }).then(function() {
                            // Redirect ke halaman indeks setelah menutup SweetAlert
                            window.location.href = '{{ route('reports.index') }}';
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

@include('layouts.footer') --}}
@include('layouts.header')

<div class="modal fade" id="reportModal" tabindex="-1" role="dialog" aria-labelledby="reportModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="reportModalLabel">Tambah Daily Report</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="POST" id="formEditReport" >
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                        <label for="presence">Tanggal</label>
                        <input type="text" class="form-control" id="date"
                            name="date" placeholder="Tanggal">
                    </div>
                    <div class="form-group">
                        <label for="presence">Presensi</label>
                        <select class="form-select form-control @error('presence') is-invalid @enderror"
                            name="presence">
                            <option value="" selected disabled>Pilih Presensi
                            </option>
                            <option value="masuk" {{ old('presence') == 'masuk' ? 'selected' : '' }}>Masuk
                            </option>
                            <option value="remote" {{ old('presence') == 'remote' ? 'selected' : '' }}>Remote
                            </option>
                            <option value="libur" {{ old('presence') == 'libur' ? 'selected' : '' }}>Libur
                            </option>
                            <option value="izin" {{ old('presence') == 'izin' ? 'selected' : '' }}>Izin
                            </option>
                        </select>

                        @error('presence')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="attendance_hours">Jam Kehadiran</label>
                        <input type="number" class="form-control @error('attendance_hours') is-invalid @enderror"
                            id="attendance_hours" placeholder="e.g. 8">
                        @error('attendance_hours')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="agency">Instansi</label>
                        <input type="text" class="form-control @error('agency') is-invalid @enderror" id="agency"
                            placeholder="e.g. Kadang Koding">
                        @error('agency')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="project_name">Nama Project</label>
                        <input type="text" class="form-control @error('project_name') is-invalid @enderror"
                            id="project_name" placeholder="e.g. Website Pendaftaran">
                        @error('project_name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="job">Pekerjaan</label>
                        <input type="text" class="form-control @error('job') is-invalid @enderror" id="job"
                            placeholder="e.g. Backend">
                        @error('job')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="description">Keterangan</label>
                        <textarea class="form-control @error('description') is-invalid @enderror" id="description"
                            placeholder="e.g. Mastering Data Intern"></textarea>
                        @error('description')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <!-- tambahkan form element lainnya sesuai kebutuhan -->
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                <button type="button" class="btn btn-success" type="submit" onclick="submitReport()">Simpan</button>
            </div>
        </div>
    </div>
</div>

{{-- <script>
    $(document).ready(function() {
        $("#formEditReport").on("submit", function(e) {
            e.preventDefault();

            var reportsId = "{{ $report->id }}";

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
                url: '{{ route('reports.update', ['reports' => ':reportsId']) }}'.replace(
                    ':reportsId', reportsId),
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
                            text: 'Report berhasil diupdate.',
                        }).then(function() {
                            // Redirect ke halaman indeks setelah menutup SweetAlert
                            window.location.href = '{{ route('reports.index') }}';
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
</script> --}}

{{-- @include('layouts.footer')  --}}
