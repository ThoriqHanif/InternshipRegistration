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
                <h3>Daftar Aspek Teknis</h3>
                <p class="text-subtitle text-muted">Berikut daftar Aspek Teknis </p>
            </div>
            <div class="col-12 col-md-6 order-md-2 order-first">
                <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('aspects.index') }}"> Daftar Aspek Penilaian </a></li>
                        <li class="breadcrumb-item active" aria-current="page">Aspek Teknis</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>

    <div class="content-wrapper">
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2 mt-2">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header d-flex justify-content-between">
                                <a href="{{ route('aspects.index') }}" class="btn btn-primary"><i
                                        class="bi bi-arrow-left me-2"></i> Kembali</a>
                                <a href="{{ route('technical-aspects.create') }}" class="btn btn-primary"><i
                                        class="bi bi-plus me-2"></i> Tambah Aspek Teknis</a>
                            </div>
                            <div class="card-body">
                                <table class="table" id="tableTechnicalAspect">
                                    <thead>
                                        <tr>
                                            <th class="table-fit">No</th>
                                            <th class="table-fit">Posisi Magang</th>
                                            <th>Jumlah Aspek</th>
                                            <th class="table-fit">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                    </tbody>
                                </table>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @include('pages.admin.aspect.technical.show')

        </section>
    </div>

    @push('table-technical-aspect')
        <script>
            let tableTechnicalAspect = new DataTable('#tableTechnicalAspect', {
                processing: true,
                serverSide: true,
                ajax: "{{ route('technical-aspects.index') }}",
                columns: [{
                        data: 'DT_RowIndex',
                        name: 'DT_RowIndex',
                        orderable: false,
                        searchable: false,
                        class: 'table-fit'
                    },
                    {
                        data: 'name',
                        name: 'name',
                        class: 'table-fit'
                    },
                    {
                        data: 'total_aspects',
                        name: 'total_aspects',
                        render: function(data) {
                            return '(' + data + ') ' + ' Aspek';
                        }
                    },
                    {
                        data: 'action',
                        name: 'action',
                        class: 'table-fit',
                        orderable: false,
                        searchable: false
                    }
                ]
            });
        </script>

        {{-- Detail Aspek --}}
        <script>
            $(document).ready(function() {
                $('#tableTechnicalAspect').on('click', 'a.detail-aspect', function() {
                    var id = $(this).data('position-id');

                    $.ajax({
                        url: '{{ route('technical-aspects.show', ':id') }}'.replace(':id', id),
                        type: 'GET',
                        success: function(response) {
                            $('#id_detail').text(response.result.id);
                            $('#position_name_detail').text(response.result.name);
                            // $('#created_at_detail').text(response.result.created_at_formatted);
                            // $('#updated_at_detail').text(response.result.updated_at_formatted);

                            $('#aspects_list').empty();

                            if (response.result.aspects && response.result.aspects.length > 0) {
                                response.result.aspects.forEach(function(aspect) {
                                    $('#aspects_list').append(
                                        '<li>' + aspect.name +'</li>'
                                    );
                                });
                            } else {
                                $('#aspects_list').append(
                                    '<li>Tidak ada aspek teknis terkait</li>');
                            }

                            $('#detailTechnicalAspect').modal('show');
                        },
                        error: function(xhr) {
                            console.log(xhr.responseText);
                        }
                    });
                });
            });
        </script>
    @endpush
@endsection
