@extends('layouts.app')

@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Position Management</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Master Data</a></li>
                            <li class="breadcrumb-item active">Posisition Management</li>
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
                                @if (auth()->check() && auth()->user()->role == 'admin')
                                <a class="btn btn-sm btn-success float-right" href="{{ route('position.create') }}"><i class="fas fa-plus mr-2 sm"></i>
                                    Posisi</a>
                                    @endif
                                <a class="btn btn-sm btn-danger float-left text-white" onclick="showDeleted()" id="showDeletedButton"><i id="showDeletedIcon" class="fas fa-trash mr-2 color-white"></i>Lihat Data Terhapus</a>

                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                @include('components.alert')
                                <div class="table-responsive">
                                <table id="tablePosition" class="table table-bordered table-hover" >
                                    <thead>
                                        <tr>
                                            <th style="width: 10px">No</th>
                                            <th>Gambar</th>
                                            <th>Nama</th>
                                            <th>Deskripsi</th>
                                            <th>Syarat</th>
                                            <th style="width: 100px">Action</th>
                                           
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
        </section>
    </div>

    @push('table-position')
    <script>
        function showDeleted() {
            // Mengubah URL Ajax yang digunakan untuk mengambil data position
            tablePosition.ajax.url("{{ route('position.index') }}?showDeleted=1").load();
    
            // Mengganti teks tombol "Lihat Arsip" menjadi "Lihat Semua"
            document.getElementById("showDeletedButton").innerHTML = "Lihat Semua";
    
            // Mengganti atribut onclick tombol "Lihat Arsip" agar dapat membatalkan tampilan data yang dihapus
            document.getElementById("showDeletedButton").setAttribute("onclick", "showAll()");
        }
    
        function showAll() {
            // Mengembalikan URL Ajax ke pengaturan semula (tanpa menampilkan data yang dihapus)
            tablePosition.ajax.url("{{ route('position.index') }}?showDeleted=0").load();
    
            // Mengganti teks tombol "Lihat Semua" kembali menjadi "Lihat Arsip"
            document.getElementById("showDeletedButton").innerHTML =
                '<i id="showDeletedIcon" class="fas fa-trash mr-2"></i> Lihat Data Terhapus';
    
            // Mengganti atribut onclick tombol "Lihat Semua" agar dapat memanggil kembali fungsi showDeleted()
            document.getElementById("showDeletedButton").setAttribute("onclick", "showDeleted()");
        }
    
    
        let tablePosition = new DataTable('#tablePosition', {
            processing: true,
            serverSide: true,
            responsive: true,
            ajax: {
                url: "{{ route('position.index') }}"
            },
    
            columns: [{
                    data: 'DT_RowIndex',
                    name: 'DT_RowIndex',
                    orderable: false,
                    searchable: false
                },
                {
                    data: 'image',
                    name: 'image',
                    render: function(data, type, full, meta) {
                        if (type === 'display') {
                            var imagePath = '{{ asset('files/image') }}/' + data;
                            return '<img src="' + imagePath +
                                '" alt="Gambar Posisi" width="40" height="40">';
                        }
                        return data;
                    }
                },
                {
                    data: 'name',
                    name: 'name'
                },
                {
                    data: 'description',
                    name: 'description'
                },
                {
                    data: 'requirements',
                    name: 'requirements'
                },
                {
                    data: 'action',
                    name: 'action'
                },
            ]
        });
    </script>
    @endpush
@endsection



