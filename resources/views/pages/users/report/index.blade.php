@extends('layouts.app')

@section('content')
    {{-- @push('button-datatable')
            <link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/jquery.dataTables.min.css">
            <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.4.2/css/buttons.dataTables.min.css">
        @endpush --}}

    <header class="mb-3">
        <a href="#" class="burger-btn d-block d-xl-none">
            <i class="bi bi-justify fs-3"></i>
        </a>
    </header>
    <div class="page-title">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h3>Daftar Report</h3>
                <p class="text-subtitle text-muted">Berikut daftar Daily Report </p>
            </div>
            <div class="col-12 col-md-6 order-md-2 order-first">
                <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item active" aria-current="page">Report</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
    <div class="content-wrapper">
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                </div>
            </div><!-- /.container-fluid -->
        </section>
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header mb-2"
                                style="display: flex; justify-content: space-between; align-items: center;">
                                <a class="float-left text-white">
                                </a>
                                <a class="btn btn-primary btn-export-pdf display float-right" id="pdfPrint"
                                    data-intern-id="{{ $internId }}" data-intern-name="{{ $interns->name }}">
                                    <i class="bi bi-printer-fill mr-2" style="margin-right: 10px"></i>
                                    Print PDF
                                </a>
                            </div>

                            <!-- /.card-header -->
                            <div class="card-body">

                                @include('components.alert')
                                <div class="table-responsive">
                                    <table class="table table-hover" id="tableReport">
                                        <thead>
                                            <tr>
                                                <th class="table-fit">No</th>
                                                <th class="table-fit">Tanggal</th>
                                                <th class="table-fit">Presensi</th>
                                                <th class="table-fit">Jam Hadir</th>
                                                <th>Instansi</th>
                                                <th>Nama Project</th>
                                                <th>Pekerjaan</th>
                                                <th>Keterangan</th>
                                                <th class="table-fit">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>

                                        </tbody>
                                    </table>
                                    {{-- FORM TAMBAH MODAL --}}
                                    <div class="modal fade" id="reportModal" tabindex="-1" role="dialog"
                                        aria-labelledby="reportModalLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-md" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="reportModalLabel">Daily Report</h5>
                                                    <button type="button" class="close" data-bs-dismiss="modal"
                                                        aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    {{-- <form method="POST" id="formEditReport" action=""> --}}
                                                    {{-- @csrf
                                                        @method('PUT') --}}
                                                    <input type="hidden" class="form-control" id="report_id"
                                                        name="report_id">
                                                    <div class="form-group">
                                                        <label for="presence">Tanggal</label>
                                                        <input type="hidden" class="form-control" id="id"
                                                            name="id">
                                                        <input type="date" class="form-control" id="date"
                                                            name="date" placeholder="Tanggal" disabled>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="presence">Presensi</label>
                                                        <select
                                                            class="form-select form-control @error('presence') is-invalid @enderror"
                                                            name="presence" id="presence">
                                                            <option value="" selected disabled>Pilih Presensi
                                                            </option>
                                                            <option value="masuk"
                                                                {{ old('presence') == 'masuk' ? 'selected' : '' }}>Masuk
                                                            </option>
                                                            <option value="remote"
                                                                {{ old('presence') == 'remote' ? 'selected' : '' }}>
                                                                Remote
                                                            </option>
                                                            <option value="libur"
                                                                {{ old('presence') == 'libur' ? 'selected' : '' }}>Libur
                                                            </option>
                                                            <option value="izin"
                                                                {{ old('presence') == 'izin' ? 'selected' : '' }}>Izin
                                                            </option>
                                                        </select>

                                                        @error('presence')
                                                            <div class="invalid-feedback">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="attendance_hours">Jam Kehadiran</label>
                                                        <input type="time" name="attendance_hours"
                                                            class="form-control @error('attendance_hours') is-invalid @enderror"
                                                            id="attendance_hours" placeholder="e.g. 8">
                                                        @error('attendance_hours')
                                                            <div class="invalid-feedback">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="agency">Instansi</label>
                                                        <input type="text" name="agency"
                                                            class="form-control @error('agency') is-invalid @enderror"
                                                            id="agency" placeholder="e.g. Kadang Koding">
                                                        @error('agency')
                                                            <div class="invalid-feedback">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="project_name">Nama Project</label>
                                                        <input type="text" name="project_name"
                                                            class="form-control @error('project_name') is-invalid @enderror"
                                                            id="project_name" placeholder="e.g. Website Pendaftaran">
                                                        @error('project_name')
                                                            <div class="invalid-feedback">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="job">Pekerjaan</label>
                                                        <input type="text" name="job"
                                                            class="form-control @error('job') is-invalid @enderror"
                                                            id="job" placeholder="e.g. Backend">
                                                        @error('job')
                                                            <div class="invalid-feedback">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="description">Keterangan</label>
                                                        <textarea class="form-control @error('description') is-invalid @enderror" id="description"
                                                            placeholder="e.g. Mastering Data Intern" name="description"></textarea>
                                                        @error('description')
                                                            <div class="invalid-feedback">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                    {{-- </form> --}}
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary"
                                                        data-bs-dismiss="modal">Tutup</button>
                                                    <button type="button" class="btn btn-primary tombol-update"
                                                        type="submit" id="saveReportBtn">Simpan</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>

                </div>
        </section>
    </div>

    @push('script-report')
        <script src="https://cdn.datatables.net/buttons/2.4.2/js/dataTables.buttons.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
        <script src="https://cdn.datatables.net/buttons/2.4.2/js/buttons.html5.min.js"></script>

        <script>
            let tableReport = new DataTable('#tableReport', {
                "createdRow": function(row, data, dataIndex) {
                    let badgeClass = '';
                    let textColor = 'text-white';

                    if (data['presence'] !== null) {
                        if (data['presence'] === 'masuk') {
                            badgeClass = 'bg-success';
                        } else if (data['presence'] === 'remote') {
                            badgeClass = 'bg-primary';
                        } else if (data['presence'] === 'izin') {
                            badgeClass = 'bg-warning';
                        } else if (data['presence'] === 'libur') {
                            badgeClass = 'bg-danger';
                        }

                        // Tambahkan badge ke dalam sel jika nilai presence tidak null
                        $(row).find('td:eq(2)').html(
                            '<span class="badge text-capitalize text-white px-2 ' +
                            badgeClass + ' ' + textColor + '">' +
                            data['presence'] + '</span>');
                    } else {
                        // Kosongkan sel jika nilai presence null
                        $(row).find('td:eq(2)').html('');
                    }

                },
                dom: 'Bfrtip',
                buttons: [{
                        extend: 'copyHtml5',
                        exportOptions: {
                            columns: ':not(.exclude)'
                        }
                    },
                    {
                        extend: 'excelHtml5',
                        exportOptions: {
                            columns: ':not(.exclude)'
                        }
                    },
                    {
                        extend: 'csvHtml5',
                        exportOptions: {
                            columns: ':not(.exclude)'
                        }
                    },

                ],
                columnDefs: [{
                    targets: 'exclude',
                    visible: false
                }],

                processing: true,
                serverSide: true,
                responsive: true,

                ajax: {
                    url: "{{ route('reports.index') }}",
                },

                columns: [{
                        data: 'DT_RowIndex',
                        name: 'DT_RowIndex',
                        orderable: false,
                        searchable: false,
                        class: 'table-fit',
                    },
                    {
                        data: 'date',
                        name: 'date',
                        class: 'table-fit',
                        render: function(data, type, row) {
                            let dateReport = new Date(data);
                            return dateReport.toLocaleDateString(
                                'id-ID', {
                                    weekday: 'long',
                                    year: 'numeric',
                                    month: 'long',
                                    day: 'numeric'
                                });
                        }
                    },
                    {
                        data: 'presence',
                        name: 'presence',
                        class: 'table-fit',
                    },
                    {
                        data: 'attendance_hours',
                        name: 'attendance_hours',
                        class: 'table-fit',
                        render: function(data, type, row) {
                            if (type === 'display' && data) {
                                let time = data.split(':').slice(0,
                                    2).join(':');
                                return time;
                            }
                            return data;
                        }
                    },
                    {
                        data: 'agency',
                        name: 'agency'
                    },
                    {
                        data: 'project_name',
                        name: 'project_name'
                    },
                    {
                        data: 'job',
                        name: 'job'
                    },
                    {
                        data: 'description',
                        name: 'description'
                    },
                    {
                        data: 'action',
                        name: 'action',
                        class: 'table-fit',
                        className: 'exclude' // Tambahkan ini untuk menandai kolom 'action'

                    },
                ]
            });

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            // 03_PROSES EDIT
            $(document).on('click', '#btn-edit', function(e) {
                var reportDate = new Date($(this).data('report-date'));
                var currentDate = new Date();

                if (reportDate > currentDate) {
                    Swal.fire({
                        icon: 'warning',
                        title: 'Eitss',
                        text: 'Belum waktunya mengisi report',
                        confirmButtonColor: "#435EBE",
                    });
                } else {
                    var id = $(this).data('report-id');
                    // console.log(id)
                    $.ajax({
                        url: '{{ route('reports.edit', ':id') }}'.replace(':id', id),
                        type: 'GET',
                        success: function(response) {
                            $('#reportModal').modal('show');
                            $('#report_id').val(response.result.id);
                            $('#date').val(response.result.date);
                            $('#presence').val(response.result.presence);
                            $('#attendance_hours').val(response.result.attendance_hours);
                            $('#agency').val(response.result.agency);
                            $('#project_name').val(response.result.project_name);
                            $('#job').val(response.result.job);
                            $('#description').val(response.result.description);

                        }
                    });
                }
                // console.log('Tekan')

            });

            $(document).on('click', '.tombol-update', function(e) {

                let reportId = $('#report_id').val();
                var var_url = '{{ route('reports.update', ':reportId') }}'.replace(':reportId', reportId);
                var var_type = 'PUT';
                $.ajax({
                    url: var_url,
                    type: var_type,
                    data: {
                        date: $('#date').val(),
                        presence: $('#presence').val(),
                        attendance_hours: $('#attendance_hours').val(),
                        agency: $('#agency').val(),
                        project_name: $('#project_name').val(),
                        job: $('#job').val(),
                        description: $('#description').val(),
                    },
                    success: function(response) {
                        if (response.errors) {
                            console.log(response.errors);

                            Swal.fire({
                                icon: 'error',
                                title: 'Gagal!',
                                confirmButtonColor: "#435EBE",
                            });


                        } else {
                            Swal.fire({
                                icon: 'success',
                                title: 'Berhasil!',
                                text: 'Data berhasil disimpan.',
                                confirmButtonColor: "#435EBE",
                            });

                            tableReport.ajax.reload(null, false);

                            $('#reportModal').modal('hide');

                        }
                    },
                    error: function(xhr) {
                        if (xhr.status === 422) {
                            // Menampilkan pesan validasi error SweetAlert
                            var errorMessages = '';
                            var errors = xhr.responseJSON.errors;
                            for (var key in errors) {
                                if (errors.hasOwnProperty(key)) {
                                    errorMessages += errors[key][0] + '<br>';
                                }
                            }

                            Swal.fire({
                                icon: 'error',
                                title: 'Gagal!',
                                html: errorMessages,
                                confirmButtonColor: "#435EBE",
                            });

                        } else {
                            Swal.fire({
                                icon: 'error',
                                title: 'Gagal!',
                                text: 'Terjadi kesalahan saat update data.',
                                confirmButtonColor: "#435EBE",
                            });
                        }
                    },
                });
                // }
            });

            $('#reportModal').on('hidden.bs.modal', function() {
                $('#date').val('');
                $('#presence').val('');
                $('#attendance_hours').val('');
                $('#agency').val('');
                $('#project_name').val('');
                $('#job').val('');
                $('#description').val('');

                $('.alert-danger').addClass('d-none');
                $('.alert-danger').html('');

                $('.alert-success').addClass('d-none');
                $('.alert-success').html('');

            });

            $(document).on('click', '.btn-export-pdf', function() {

                let internId = $(this).data('intern-id');

                let internName = $(this).data('intern-name');

                console.log(internId)

                console.log(internName)



                Swal.fire({

                    title: 'Mohon Tunggu!',

                    html: 'Generate PDF..',

                    allowOutsideClick: false,

                    showConfirmButton: false,

                    willOpen: () => {

                        Swal.showLoading();

                    },

                });



                fetch('{{ route('intern.export.report.pdf', ':internId') }}'.replace(':internId', internId))

                    .then(response => {

                        Swal.close();

                        return response.blob();

                    })

                    .then(blob => {

                        const url = window.URL.createObjectURL(blob);

                        const link = document.createElement('a');

                        link.href = url;

                        link.download = 'Laporan Harian Magang :' + '.pdf';



                        // Tambahkan tautan ke dokumen dan klik otomatis

                        document.body.appendChild(link);

                        link.click();



                        // Hapus tautan setelah diunduh

                        document.body.removeChild(link);

                    })

                    .catch(error => {

                        console.error(error);



                        Swal.fire({

                            icon: 'error',

                            title: 'Oops...',

                            text: 'Terjadi Kesahalahan',
                            confirmButtonColor: "#435EBE",

                        });

                    });

            });
        </script>
    @endpush
@endsection
