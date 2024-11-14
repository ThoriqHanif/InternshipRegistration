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
                <h3>Daftar Log Aktivitas</h3>
                <p class="text-subtitle text-muted">Berikut daftar Log Aktivitas </p>
            </div>
            <div class="col-12 col-md-6 order-md-2 order-first">
                <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item active" aria-current="page">Log Aktivitas</li>
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
            <div class="card">
                <div class="card-header mb-2 justify-content-end"
                    style="display: flex; align-items: center; justify-content: space-between;">
                </div>

                <div class="card-body">
                    @include('components.alert')
                    {{-- <div class="table-responsive"> --}}
                    <table class="table table-hover " id="tableLogActivity">
                        <thead>
                            <tr>
                                <th class="table-fit">Tanggal</th>
                                <th>User</th>
                                <th>Aktivitas</th>
                                <th class="table-fit">Action</th>
                            </tr>
                        </thead>
                        <tbody>

                        </tbody>
                    </table>
                    {{-- </div> --}}
                </div>
            </div>
        </section>

        @include('pages.admin.log-activity.show')

        @push('table-log-activity')
            <script>
                let tableLogActivity = new DataTable('#tableLogActivity', {
                    processing: true,
                    serverSide: true,
                    responsive: true,
                    ajax: {
                        url: "{{ route('log-activities.index') }}",
                    },
                    columns: [{
                            data: 'created_at',
                            name: 'created_at',
                            class: 'table-fit',
                            render: function(data, type, row) {
                                const date = new Date(data);

                                const options = {
                                    year: 'numeric',
                                    month: '2-digit',
                                    day: '2-digit',
                                    hour: '2-digit',
                                    minute: '2-digit',
                                    second: '2-digit',
                                    hour12: false,
                                    // timeZoneName: 'short',
                                };

                                const formattedDate = date.toLocaleString('id-ID', options).replace(',',
                                    '');
                                return formattedDate;
                            }
                        },
                        {
                            data: 'user.name',
                            name: 'user.name',
                            render: function(data, type, row) {
                                return data ? data : 'Unkwown';
                            }
                        },
                        {
                            data: 'activity',
                            name: 'activity',
                        },
                        {
                            data: 'action',
                            name: 'action',
                            class: 'table-fit'
                        },


                    ]
                });
            </script>

            {{-- Detail --}}
            <script>
                $(document).ready(function() {
                    $('#tableLogActivity').on('click', 'a.detail-log-activity', function() {
                        var id = $(this).data('log-activity-id');
                        var baseUrl = "{{ url('') }}";

                        $.ajax({
                            url: '{{ route('log-activities.show', ':id') }}'.replace(':id', id),
                            type: 'GET',
                            success: function(response) {
                                console.log(response);
                                $('#detailLogActivity').modal('show');

                                $('#id').val(response.result.id || 'N/A');
                                $('#date_detail').text(response.result.created_at_formatted || 'N/A');
                                $('#user_detail').text(response.result.user ? response.result.user.name : 'Uknown');
                                $('#activity_detail').text(response.result.activity || 'N/A');
                                $('#url_detail').text(response.result.url || baseUrl + '/');
                                $('#ip_detail').text(response.result.ip || 'N/A');
                                $('#agent_detail').text(response.result.agent || 'N/A');

                                var show = response.result.show;
                                var fullUrl = baseUrl + '/' + (show || 'N/A');
                                $('#show_detail').html(show ? '<a href="' + fullUrl +
                                    '" target="_blank">' + fullUrl +
                                    ' <i class="bi bi-box-arrow-up-right"></i></a>' : '-');

                                // Safely handle the data detail
                                var data = response.result.data ? response.result.data : {};
                                $('#data_detail').html('<pre>' + JSON.stringify(data, null, 2) +
                                    '</pre>');
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
