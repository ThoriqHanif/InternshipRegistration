@if (!$positions->trashed())
    <a href="{{ route('position.show', $positions->id) }}"
        class="btn btn-sm bg-primary text-white font-weight-bold text-xs" data-toggle="tooltip" data-placement="top"
        title="Detail Pemagang">
        <i class="bi bi-eye"></i>
    </a>
    <a href="{{ route('position.edit', $positions->id) }}"
        class="btn btn-sm bg-warning text-white font-weight-bold text-xs" data-toggle="tooltip" data-placement="top"
        title="Edit Pemagang">
        <i class="bi bi-pencil-square"></i>
    </a>
    <form style="display: inline" action="{{ route('position.destroy', $positions->id) }}" method="POST">
        @csrf
        @method('DELETE')
        <button type="submit" class="btn btn-sm btn-danger delete-button" data-toggle="tooltip" data-placement="top"
            title="Hapus Pemagang">
            <i class="bi bi-trash"></i>
        </button>
    </form>
@endif

@if ($positions->trashed())
    <form style="display: inline" action="{{ route('position.restore', $positions->id) }}" method="POST"
        id="restoreForm">
        @csrf
        <button type="submit" class="btn btn-sm btn-info restore-button" data-toggle="tooltip" data-placement="top"
            title="Restore Posisi">
            <i class="bi bi-arrow-counterclockwise"></i>
        </button>
    </form>
    <form style="display: inline" action="{{ route('position.forceDelete', $positions->id) }}" method="POST"
        id="forceDeleteFormPosition">
        @csrf
        @method('DELETE')
        <button type="submit" class="btn btn-sm btn-danger delete-button-position" data-toggle="tooltip"
            data-placement="top" title="Hapus Permanen Posisi">
            <i class="bi bi-trash"></i>
        </button>
    </form>
@endif

<script>
    $(document).ready(function() {
        $('.restore-button').on('click', function(e) {
            e.preventDefault();
            var restoreButton = $(this);
            var restoreForm = restoreButton.closest('#restoreForm');

            Swal.fire({
                title: 'Konfirmasi Restore',
                text: 'Anda yakin ingin mengembalikan posisi ini?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Ya, Restore',
                cancelButtonText: 'Batal',
                confirmButtonColor: "#435EBE",
                cancelButtonColor: "#CDD3D8",
            }).then((result) => {
                if (result.isConfirmed) {
                    Swal.fire({
                        title: 'Mohon Tunggu!',
                        html: 'Sedang mengembalikan posisi...',
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
                                    text: 'Posisi berhasil di-restore.',
                                }).then(function() {
                                    // Refresh DataTable
                                    tablePosition.ajax.reload();
                                    window.location.href =
                                        '{{ route('position.index') }}';
                                });
                            } else {
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Oops...',
                                    text: 'Posisi gagal di-restore.',
                                    confirmButtonColor: "#435EBE",
                                });
                            }
                        },
                        error: function() {
                            Swal.close();
                            Swal.fire({
                                icon: 'error',
                                title: 'Oops...',
                                text: 'Terjadi kesalahan saat mengembalikan posisi.',
                                confirmButtonColor: "#435EBE",
                            });
                        }
                    });
                }
            });
        });
    });
</script>

<script>
    $(document).ready(function() {
        $('.delete-button-position').on('click', function(e) {
            e.preventDefault();
            var deleteButton = $(this);
            var deleteForm = deleteButton.closest('#forceDeleteFormPosition');

            Swal.fire({
                title: 'Konfirmasi Hapus Permanen',
                text: 'Menghapus posisi ini akan mengosongkan posisi dengan pemagang terkait?',
                icon: 'warning',
                confirmButtonColor: "#435EBE",
                cancelButtonColor: "#CDD3D8",
            }).then((result) => {
                if (result.isConfirmed) {
                    Swal.fire({
                        title: 'Mohon Tunggu!',
                        html: 'Sedang menghapus posisi...',
                        allowOutsideClick: false,
                        showConfirmButton: false,
                        willOpen: () => {
                            Swal.showLoading();
                        },
                    });

                    $.ajax({
                        type: 'DELETE',
                        url: deleteForm.attr('action'),
                        data: deleteForm.serialize(),
                        success: function(response) {
                            Swal.close();

                            if (response.success) {
                                Swal.fire({
                                    icon: 'success',
                                    title: 'Berhasil!',
                                    text: 'Posisi Magang berhasil dihapus secara permanen.',
                                    confirmButtonColor: "#435EBE",
                                    cancelButtonColor: "#CDD3D8",
                                }).then(function() {
                                    tablePosition.ajax.reload();
                                    window.location.href =
                                        '{{ route('position.index') }}';
                                });
                            } else {
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Oops...',
                                    text: 'Posisi Magang gagal dihapus secara permanen.',
                                    confirmButtonColor: "#435EBE",
                                });
                            }
                        },
                        error: function() {
                            Swal.close();
                            Swal.fire({
                                icon: 'error',
                                title: 'Oops...',
                                text: 'Terjadi kesalahan saat menghapus pemagang secara permanen.',
                                confirmButtonColor: "#435EBE",
                            });
                        }
                    });
                }
            });
        });
    });
</script>

<script>
    $(document).ready(function() {
        $('.delete-button').on('click', function(e) {
            e.preventDefault();
            var deleteButton = $(this);
            Swal.fire({
                title: 'Konfirmasi Hapus',
                text: 'Anda yakin ingin menghapus posisi ini?',
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
                        html: 'Sedang menghapus pengguna...',
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
                                    text: 'Data posisi berhasil dihapus.',
                                    confirmButtonColor: "#435EBE",
                                    cancelButtonColor: "#CDD3D8",
                                }).then(function() {
                                    tablePosition.ajax.reload();

                                });
                            } else {
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Oops...',
                                    text: 'Posisi gagal dihapus.',
                                    confirmButtonColor: "#435EBE",
                                });
                            }
                        },
                        error: function() {
                            Swal.close();

                            Swal.fire({
                                icon: 'error',
                                title: 'Oops...',
                                text: 'Terjadi kesalahan saat menghapus posisi.',
                                confirmButtonColor: "#435EBE",
                            });
                        }
                    });
                }
            });
        });
    });
</script>
