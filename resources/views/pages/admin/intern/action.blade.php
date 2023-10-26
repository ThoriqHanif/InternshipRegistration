@if (!$intern->trashed())
<a href="{{ route('intern.download', ['id' => $intern->id]) }}"
    class="btn btn-sm bg-info text-white font-weight-bold text-xs" data-toggle="tooltip" data-placement="top" title="Download Files">
    <i class="fas fa-download"></i>
</a>
<a href="{{ route('intern.show', $intern->id) }}"
    class="btn btn-sm bg-primary text-white font-weight-bold text-xs" data-toggle="tooltip" data-placement="top" title="Detail Pemagang">
    <i class="fas fa-eye"></i>
</a>
<a href="{{ route('intern.edit', $intern->id) }}"
    class="btn btn-sm bg-warning text-white font-weight-bold text-xs" data-toggle="tooltip" data-placement="top" title="Edit Pemagang">
    <i class="fas fa-edit"></i>
</a>
<form style="display: inline" action="{{ route('intern.destroy', $intern->id) }}" method="POST">
    @csrf
    @method('DELETE')
    <button type="submit" class="btn btn-sm btn-danger delete-button" data-toggle="tooltip" data-placement="top" title="Hapus Pemagang">
        <i class="fas fa-trash"></i>
    </button>
</form>
@endif

@if ($intern->trashed())
<form style="display: inline" action="{{ route('intern.restore', $intern->id) }}" method="POST" id="restoreFormIntern">
    @csrf
    <button type="submit" class="btn btn-sm btn-success restore-button-intern" data-toggle="tooltip" data-placement="top" title="Restore Pemagang">
        <i class="fas fa-undo"></i>
    </button>
</form>
@endif

<script>
    $(document).ready(function() {
        // Event handler untuk tombol restore
        $('.restore-button-intern').on('click', function(e) {
            e.preventDefault();
            var restoreButton = $(this);
            var restoreForm = restoreButton.closest('#restoreFormIntern');

            Swal.fire({
                title: 'Konfirmasi Restore',
                text: 'Anda yakin ingin mengembalikan pemagang ini?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Ya, Restore',
                cancelButtonText: 'Batal',
            }).then((result) => {
                if (result.isConfirmed) {
                    Swal.fire({
                        title: 'Mohon Tunggu!',
                        html: 'Sedang mengembalikan pemagang...',
                        allowOutsideClick: false,
                        showConfirmButton: false,
                        willOpen: () => {
                            Swal.showLoading();
                        },
                    });

                    $.ajax({
                        type: 'POST',
                        url: restoreForm.attr('action'),
                        data: restoreForm.serialize(),
                        success: function(response) {
                            Swal.close();

                            if (response.success) {
                                Swal.fire({
                                    icon: 'success',
                                    title: 'Berhasil!',
                                    text: 'Pemagang berhasil di-restore.',
                                }).then(function() {
                                    // Refresh DataTable
                                    tableIntern.ajax.reload();
                                    window.location.href = '{{ route('intern.index') }}';
                                });
                            } else {
                                Swal.fire('Gagal', 'Gagal mengembalikan posisi', 'error');
                            }
                        },
                        error: function() {
                            Swal.close();
                            Swal.fire('Gagal', 'Terjadi kesalahan saat mengembalikan posisi', 'error');
                        }
                    });
                }
            });
        });
    });
</script>


<script>
    $(document).ready(function() {
        // Memberikan event handler untuk tombol hapus
        $('.delete-button').on('click', function(e) {
            e.preventDefault();
            var deleteButton = $(this);
            Swal.fire({
                title: 'Konfirmasi Hapus',
                text: 'Anda yakin ingin menghapus pemagang ini?',
                icon: 'error',
                showCancelButton: true,
                confirmButtonText: 'Ya, Hapus',
                cancelButtonText: 'Batal',
            }).then((result) => {
                if (result.isConfirmed) {
                    Swal.fire({
                        title: 'Mohon Tunggu!',
                        html: 'Sedang menghapus pemagang...',
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
                                    text: 'Data pemagang berhasil dihapus.',
                                }).then(function() {
                                    tableIntern.ajax.reload();
                                    // window.location.href = '{{ route('intern.index') }}';

                                });
                                // Tambahkan kode lain yang sesuai, seperti memperbarui tampilan tabel.
                            } else {
                                Swal.fire('Gagal', 'Gagal menghapus pemagang',
                                    'error');
                            }
                        },
                        error: function() {
                            // Tutup pesan "loading"
                            Swal.close();

                            Swal.fire('Gagal',
                                'Terjadi kesalahan saat menghapus pemagang',
                                'error');
                        }
                    });
                }
            });
        });
    });
</script>