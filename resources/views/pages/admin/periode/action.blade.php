{{-- <a href="{{ route('users.download', ['id' => $users->id]) }}"
    class="btn btn-sm bg-info text-white font-weight-bold text-xs" data-toggle="tooltip" data-placement="top" title="Download Files">
    <i class="fas fa-download"></i>
</a> --}}
<a class="btn btn-sm bg-primary text-white font-weight-bold text-xs detail-periode" data-toggle="tooltip"
    data-placement="top" title="Detail Periode" data-periode-id={{ $periode->id }}>
    <i class="bi bi-eye"></i>
</a>
<a href="{{ route('periode.edit', $periode->id) }}" class="btn btn-sm bg-warning text-white font-weight-bold text-xs"
    data-toggle="tooltip" data-placement="top" title="Edit Periode">
    <i class="bi bi-pencil-square"></i>
</a>
<form style="display: inline" action="{{ route('periode.destroy', $periode->id) }}" method="POST">
    @csrf
    @method('DELETE')
    <button type="submit" class="btn btn-sm btn-danger delete-button" data-toggle="tooltip" data-placement="top"
        title="Hapus Periode">
        <i class="bi bi-trash"></i>
    </button>
</form>

<script>
    $(document).ready(function() {
        $('.delete-button').on('click', function(e) {
            e.preventDefault();
            var deleteButton = $(this);
            Swal.fire({
                title: 'Yakin menghapus periode?',
                text: 'Menghapus periode ini akan menghapus semua pemagang yang terkait',
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
                        html: 'Sedang menghapus periode...',
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
                                    text: 'Data periode berhasil dihapus.',
                                    confirmButtonColor: "#435EBE",
                                    cancelButtonColor: "#CDD3D8",
                                }).then(function() {
                                    tablePeriode.ajax.reload();

                                });
                            } else {
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Oops...',
                                    text: 'Gagal menghapus periode',
                                    confirmButtonColor: "#435EBE",
                                });
                            }
                        },
                        error: function() {
                            Swal.close();

                            Swal.fire({
                                icon: 'error',
                                title: 'Oops...',
                                text: 'Terjadi kesalahan saat menghapus periode',
                                confirmButtonColor: "#435EBE",
                            });
                        }
                    });
                }
            });
        });
    });
</script>
