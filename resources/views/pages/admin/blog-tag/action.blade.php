<a class="btn btn-sm bg-primary text-white font-weight-bold text-xs detail-tag" data-toggle="tooltip" data-placement="top"
    title="Detail Kategori Blog" data-tag-id={{ $tag->id }}>
    <i class="bi bi-eye"></i>
</a>
<a class="btn btn-sm bg-warning text-white font-weight-bold text-xs edit-tag" data-toggle="tooltip" data-placement="top"
    title="Edit Kategori Blog" data-tag-id={{ $tag->id }}>
    <i class="bi bi-pencil-square"></i>
</a>
<form style="display: inline" action="{{ route('tags.destroy', $tag->id) }}" method="POST">
    @csrf
    @method('DELETE')
    <button type="submit" class="btn btn-sm btn-danger delete-button" data-toggle="tooltip" data-placement="top"
        title="Hapus Tag">
        <i class="bi bi-trash"></i>
    </button>
</form>

<script>
    $(document).ready(function() {
        $('.delete-button').on('click', function(e) {
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
                                    tableTag.ajax.reload();
                                });
                            } else {
                                Swal.fire('Gagal', 'Gagal menghapus data','error');

                            }
                        },
                        error: function() {
                            // Tutup pesan "loading"
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
