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
                <h3>Penilaian</h3>
                <p class="text-subtitle text-muted">Penilaian Akhir {{ $interns->full_name }} </p>
            </div>
            <div class="col-12 col-md-6 order-md-2 order-first">
                <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('evaluations.index') }}">Penilaian</a></li>
                        <li class="breadcrumb-item active" aria-current="page"><a
                                href="{{ route('evaluations.show', $interns->id) }}">{{ $interns->full_name }}</a></li>
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
            </div>
        </section>

        <section class="section mt-2">
            <div class="card" style="margin-bottom: 10px !important;">
                <div class="card-body" style="padding-bottom: 5px !important;">
                    <div class="row">
                        <div class="col-6">
                            <table class="table table-borderless">
                                <tr>
                                    <th>Nama Pemagang : </th>
                                </tr>
                                <tr>
                                    <td>{{ $interns->full_name }}</td>
                                </tr>
                            </table>
                        </div>
                        <div class="col-6">
                            <table class="table table-borderless">
                                <tr>
                                    <th>Posisi Pemagang : </th>
                                </tr>
                                <tr>
                                    <td>{{ $interns->position->name }}</td>
                                </tr>
                                {{-- <tr>
                                    <td>Nilai Akhir</td>
                                </tr> --}}
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card">
                <div class="card-header d-flex justify-content-between">
                    <div class="form-group">
                        <label for="">Daftar Penilaian</label>
                    </div>
                    <div class="">
                        <a class="btn btn-primary btn-export-pdf display float-right" id="exportPDF"
                            data-intern-id="{{ $interns->id }}" data-intern-name="{{ $interns->full_name }}">
                            <i class="bi bi-printer-fill mr-2" style="margin-right: 10px"></i>
                            Export PDF
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    <input type="hidden" name="intern_id" value="{{ $interns->id }}">
                    <table id="finalScoreTable" class="table table-hover">
                        <thead>
                            <tr>
                                <th class="table-fit">No</th>
                                <th>Kriteria</th>
                                <th class="table-fit">Nilai Akhir</th>
                                <th class="table-fit">Nilai Huruf</th>
                                <th class="table-fit">Predikat</th>
                            </tr>
                        </thead>
                        <tbody>

                        </tbody>
                    </table>

                </div>
            </div>
        </section>
    </div>

    @push('table-final-scores')
        <script>
            let finalScoreTable = new DataTable('#finalScoreTable', {
                processing: true,
                serverSide: true,
                responsive: true,
                ajax: {
                    url: "{{ route('evaluations.final.score', $interns->id) }}"
                },
                columns: [{
                        data: 'DT_RowIndex',
                        name: 'DT_RowIndex',
                        orderable: false,
                        searchable: false,
                        class: 'table-fit',
                    },
                    {
                        data: 'aspect.name',
                        name: 'aspect.name',
                    },
                    {
                        data: 'final_score',
                        name: 'final_score',
                        class: 'table-fit'
                    },
                    {
                        data: 'letter_grade',
                        name: 'letter_grade',
                        class: 'table-fit'
                    },
                    {
                        data: 'predicate',
                        name: 'predicate',
                        class: 'table-fit'
                    }
                ]
            });
        </script>

        {{-- Export PDF --}}
        <script>
            $(document).on('click', '#exportPDF', function() {
                let internId = $(this).data('intern-id');
                let internName = $(this).data('intern-name');

                Swal.fire({
                    title: 'Mohon Tunggu!',
                    html: 'Generate PDF..',
                    allowOutsideClick: false,
                    showConfirmButton: false,

                    willOpen: () => {
                        Swal.showLoading();
                    },
                });

                $.ajax({
                    url: '{{ route('evaluations.final.score.export', ':internId') }}'.replace(':internId',
                        internId),
                    type: 'GET',
                    xhrFields: {
                        responseType: 'blob'
                    },
                    success: function(response) {
                        Swal.close();

                        const url = window.URL.createObjectURL(response);
                        const link = document.createElement('a');
                        link.href = url;
                        link.download = 'Rekap Nilai Magang - ' + internName + '.pdf';
                        document.body.appendChild(link);
                        link.click();
                        document.body.removeChild(link);

                    },
                    error: function() {
                        Swal.fire({
                            icon: 'error',
                            title: 'Error',
                            text: 'Terjadi kesalahan saat mengambil data.',
                            confirmButtonText: 'OK',
                            confirmButtonColor: "#435EBE",
                        });
                    }
                });
            });
        </script>
    @endpush
@endsection
