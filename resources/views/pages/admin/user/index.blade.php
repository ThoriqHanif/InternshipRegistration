@extends('layouts.app')

@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>User Management</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Master Data</a></li>
              <li class="breadcrumb-item active">User Managemenent</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>
<section class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-12">
          <div class="card">
            <div class="card-header">
              {{-- <h3 class="card-title">User Managament</h3> --}}
              <a class="btn btn-md btn-success float-right" href="{{ route('users.create') }}"> + User</a>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              
              @include('components.alert')
              <div class="table-responsive">
              <table class="table table-bordered table-hover" id="tableUser">
                <thead>
                  <tr>
                    <th style="width: 10px">No</th>
                    <th>Nama</th>
                    <th>Email</th>
                    <th>Role</th>
                    <th style="width: 100px">Action</th>
                  </tr>
                </thead>
                <tbody>
                 
                </tbody>
              </table>
              </div>
            </div>
            <!-- /.card-body -->
           {{-- <div class="card-footer clearfix">
                                <ul class="pagination pagination-sm m-0 float-right">
                                    <li class="page-item {{ $user->onFirstPage() ? 'disabled' : '' }}">
                                        <a class="page-link" href="{{ $user->previousPageUrl() }}">&laquo;</a>
                                    </li>
                                    @for ($i = 1; $i <= $user->lastPage(); $i++)
                                        <li class="page-item {{ $i == $user->currentPage() ? 'active' : '' }}">
                                            <a class="page-link" href="{{ $user->url($i) }}">{{ $i }}</a>
                                        </li>
                                    @endfor
                                    <li
                                        class="page-item {{ $user->currentPage() == $user->lastPage() ? 'disabled' : '' }}">
                                        <a class="page-link" href="{{ $user->nextPageUrl() }}">&raquo;</a>
                                    </li>
                                </ul>
                            </div> --}}
          </div>
        </div>
        
    </div>
  </section>
</div>

{{-- <script>
  $(document).ready(function() {
      // Memberikan event handler untuk tombol hapus
      $('.delete-button').on('click', function(e) {
          e.preventDefault();
          var deleteButton = $(this);

          Swal.fire({
              title: 'Konfirmasi Hapus',
              text: 'Anda yakin ingin menghapus pengguna ini?',
              icon: 'error',
              showCancelButton: true,
              confirmButtonText: 'Ya, Hapus',
              cancelButtonText: 'Batal',
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
                                  text: 'Data pengguna berhasil dihapus.',
                              }).then(function() {
                                  $('#tableUser').DataTable().ajax.reload();

                              });
                              // Tambahkan kode lain yang sesuai, seperti memperbarui tampilan tabel.
                          } else {
                              Swal.fire('Gagal', 'Gagal menghapus pengguna',
                                  'error');
                          }
                      },
                      error: function() {
                          // Tutup pesan "loading"
                          Swal.close();

                          Swal.fire('Gagal',
                              'Terjadi kesalahan saat menghapus pengguna',
                              'error');
                      }
                  });
              }
          });
      });
  });
</script> --}}

{{-- <script>
  $(document).ready(function() {
      // Memberikan event handler untuk tombol hapus
      $('.delete-button').on('click', function(e) {
          e.preventDefault();
          var deleteButton = $(this);
  
          Swal.fire({
              title: 'Konfirmasi Hapus',
              text: 'Anda yakin ingin menghapus pengguna ini?',
              icon: 'error',
              showCancelButton: true,
              confirmButtonText: 'Ya, Hapus',
              cancelButtonText: 'Batal',
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
                              Swal.fire('Berhasil', 'Pengguna berhasil dihapus', 'success');
                              $('#tableUser').DataTable().ajax.reload();
                              // Tambahkan kode lain yang sesuai, seperti memperbarui tampilan tabel.
                          } else {
                              Swal.fire('Gagal', 'Gagal menghapus pengguna', 'error');
                          }
                      },
                      error: function() {
                          // Tutup pesan "loading"
                          Swal.close();
  
                          Swal.fire('Gagal', 'Terjadi kesalahan saat menghapus pengguna', 'error');
                      }
                  });
              }
          });
      });
  });
</script> --}}

{{-- <script>
  $(document).ready(function() {
      var dataTable = $('#data-table').DataTable({
          processing: true,
          serverSide: true,
          ajax: '{{ route('users.index') }}',
          columns: [
              { data: 'name', name: 'name' },
              { data: 'email', name: 'email' },
              { data: 'action', name: 'action', orderable: false, searchable: false },
          ]
      });
  
      $('#data-table').on('click', '.delete-button', function(e) {
          e.preventDefault();
          var deleteButton = $(this);
          var url = deleteButton.attr('data-url');
  
          Swal.fire({
              title: 'Konfirmasi Hapus',
              text: 'Anda yakin ingin menghapus pengguna ini?',
              icon: 'warning',
              showCancelButton: true,
              confirmButtonText: 'Ya, Hapus',
              cancelButtonText: 'Batal',
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
                      type: 'DELETE',
                      url: url,
                      success: function(response) {
                          Swal.close();
                          if (response.success) {
                              Swal.fire('Berhasil', 'Pengguna berhasil dihapus', 'success');
                              dataTable.ajax.reload();
                          } else {
                              Swal.fire('Gagal', 'Gagal menghapus pengguna', 'error');
                          }
                      },
                      error: function() {
                          Swal.close();
                          Swal.fire('Gagal', 'Terjadi kesalahan saat menghapus pengguna', 'error');
                      }
                  });
              }
          });
      });
  });
  </script> --}}
@endsection





