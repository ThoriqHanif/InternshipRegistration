<a type="button" class="btn btn-sm bg-primary text-white font-weight-bold text-xs detail-aspect" data-toggle="tooltip"
    data-placement="top" title="Detail Aspek Non Teknis" data-aspect-id={{ $aspect->id }}>
    <i class="bi bi-eye"></i>
</a>
<a type="button" class="btn btn-sm bg-warning text-white font-weight-bold text-xs edit-aspect" data-toggle="tooltip"
    data-placement="top" title="Edit Aspek Non Teknis" data-aspect-id={{ $aspect->id }}>
    <i class="bi bi-pencil-square"></i>
</a>
<form style="display: inline" action="{{ route('non-technical-aspects.destroy', $aspect->id) }}" method="POST"
    id="deleteFormAspect">
    @csrf
    @method('DELETE')
    <button type="submit" class="btn btn-sm btn-danger delete-button" id="deleteButton" data-toggle="tooltip"
        data-placement="top" title="Hapus Aspek Non Teknis">
        <i class="bi bi-trash"></i>
    </button>
</form>


<script>
    $(document).ready(function() {
        $('#deleteButton').on('click', function(e) {
            console.log('clicked');

            e.preventDefault();
            var deleteButton = $(this);
            Swal.fire({
                title: 'Konfirmasi Hapus',
                text: 'Anda yakin ingin menghapus data ini?',
                icon: 'error',
                showCancelButton: true,
                confirmButtonText: 'Ya, Hapus',
                cancelButtonText: 'Batal',
                confirmButtonColor: "#435EBE",
                cancelButtonColor: "#CDD3D8",
            }).then((result) => {
                if (result.isConfirmed) {
                    Swal.fire({
                        title: 'Mohon Tunggu!',
                        html: 'Sedang menghapus data...',
                        allowOutsideClick: false,
                        showConfirmButton: false,
                        willOpen: () => {
                            Swal.showLoading();
                        },
                    });

                    $.ajax({
                        type: 'POST',
                        url: deleteButton.closest('form').attr('action'),
                        data: deleteButton.closest('form').serialize(),
                        success: function(response) {
                            Swal.close();

                            if (response.success) {
                                Swal.fire({
                                    icon: 'success',
                                    title: 'Berhasil!',
                                    text: 'Data berhasil dihapus.',
                                    confirmButtonColor: "#435EBE",
                                    cancelButtonColor: "#CDD3D8",
                                }).then(function() {
                                    $('#tableNonTechnicalAspect').DataTable().ajax.reload(null, false);
                                });
                            } else {
                                Swal.fire('Gagal', 'Gagal menghapus data', 'error');

                            }
                        },
                        error: function() {
                            Swal.close();

                            Swal.fire('Gagal',
                                'Terjadi kesalahan saat menghapus data',
                                'error');
                        }
                    });
                }
            });
        });
    });
</script>
