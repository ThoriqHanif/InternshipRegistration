{{-- <a href="{{ route('users.download', ['id' => $users->id]) }}"
    class="btn btn-sm bg-info text-white font-weight-bold text-xs" data-toggle="tooltip" data-placement="top" title="Download Files">
    <i class="fas fa-download"></i>
</a> --}}
<a href="{{ route('periode.show', $periode->id) }}" class="btn btn-sm bg-primary text-white font-weight-bold text-xs"
    data-toggle="tooltip" data-placement="top" title="Detail Periode">
    <i class="fas fa-eye"></i>
</a>
<a href="{{ route('periode.edit', $periode->id) }}" class="btn btn-sm bg-warning text-white font-weight-bold text-xs"
    data-toggle="tooltip" data-placement="top" title="Edit Periode">
    <i class="fas fa-edit"></i>
</a>
<form style="display: inline" action="{{ route('periode.destroy', $periode->id) }}" method="POST">
    @csrf
    @method('DELETE')
    <button type="submit" class="btn btn-sm btn-danger delete-button" data-toggle="tooltip" data-placement="top"
        title="Hapus Periode">
        <i class="fas fa-trash"></i>
    </button>
</form>

<script>
    $(document).ready(function() {
        // Memberikan event handler untuk tombol hapus
        $('.delete-button').on('click', function(e) {
            e.preventDefault();
            var deleteButton = $(this);
            Swal.fire({
                title: 'Konfirmasi Hapus',
                text: 'Anda yakin ingin menghapus periode ini?',
                icon: 'error',
                showCancelButton: true,
                confirmButtonText: 'Ya, Hapus',
                cancelButtonText: 'Batal',
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

                    // Jika pengguna mengkonfirmasi penghapusan, kirimkan permintaan penghapusan
                    $.ajax({
                        type: 'POST',
                        url: deleteButton.closest('form').attr('action'),
                        data: deleteButton.closest('form').serialize(),
                        success: function(response) {
                            // Tutup pesan "loading"
                            Swal.close();

                            // Handle pesan hasil penghapusan
                            if (response.success) {
                                Swal.fire({
                                    icon: 'success',
                                    title: 'Berhasil!',
                                    text: 'Data periode berhasil dihapus.',
                                }).then(function() {
                                    tablePeriode.ajax.reload();
                                    // window.location.href = '{{ route('intern.index') }}';

                                });
                                // Tambahkan kode lain yang sesuai, seperti memperbarui tampilan tabel.
                            } else {
                                Swal.fire('Gagal', 'Gagal menghapus periode',
                                    'error');
                            }
                        },
                        error: function() {
                            // Tutup pesan "loading"
                            Swal.close();

                            Swal.fire('Gagal',
                                'Terjadi kesalahan saat menghapus periode',
                                'error');
                        }
                    });
                }
            });
        });
    });
</script>