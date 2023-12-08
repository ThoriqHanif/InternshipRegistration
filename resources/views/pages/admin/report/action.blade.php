<a class="btn btn-sm bg-info text-white  btn-view-interns" data-periode-id="{{ $periode->id }}"
    data-toggle="tooltip" data-placement="top" title="Lihat Pemagang">
    <i class="fas fa-users mr-2"></i> Lihat Pemagang
</a>



{{-- <script>
    $(document).ready(function() {
        // Aksi ketika tombol "Lihat Pemagang" diklik
        $(document).on('click', '.btn-view-interns', function() {
            let periodeId = $(this).data('periode-id');
            console.log(periodeId);

            $.ajax({
                url: '/admin/intern/' + periodeId,
                method: 'GET',
                success: function(response) {

                    $('#tablePeriode').DataTable().destroy();
                    $('#internByPeriode').DataTable().destroy();

                    $('#internByPeriode').DataTable({
                        data: response,
                       
                        columns: [{
                                data: 'DT_RowIndex',
                                name: 'DT_RowIndex',
                                orderable: false,
                                searchable: false
                            },
                            {
                                data: 'full_name',
                                name: 'full_name'
                            },
                            {
                                data: 'school',
                                name: 'school'
                            },
                            {
                                data: 'position.name',
                                name: 'position.name'
                            },
                            {
                                data: 'start_date',
                                name: 'start_date'
                            },
                            {
                                data: 'end_date',
                                name: 'end_date'
                            },
                            {
                                data: 'status',
                                name: 'status'
                            },
                            {
                                data: 'action',
                                name: 'action'
                            },
                        ],
                        // Munculkan tabel intern yang sebelumnya di-hide
                        "drawCallback": function(settings) {
                            $('#tablePeriode').hide();
                            $('#internByPeriode').show();
                        }
                    });
                },
                error: function(error) {
                    console.error(error);
                }
            });
        });
    });
</script> --}}
