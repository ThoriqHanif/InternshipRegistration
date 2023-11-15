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
                                <a class="btn btn-sm btn-danger float-left" onclick="showDeleted()" id="showDeletedButton"><i id="showDeletedIcon" class="fas fa-trash mr-2"></i>Lihat Data Terhapus</a>

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
                                        {{-- @foreach ($positions as $key => $item)
                                            <tr>
                                                <td>
                                                    <div class="d-flex px-3 py-1">
                                                        <div class="d-flex flex-column justify-content-center">
                                                            <h6 class="mb-0 text-sm">{{ $key + 1 }}</h6>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="d-flex px-3 py-1">
                                                        <div class="d-flex flex-column justify-content-center">
                                                            <h6 class="mb-0 text-sm">{{ $item->name }}</h6>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>
                                                    <p class="text-sm mb-0">{{ $item->description }}</p>
                                                </td>
                                                <td class=" text-sm">
                                                    <p class="text-sm  mb-0">{{ $item->requirements }}</p>
                                                </td>
                                                @if (auth()->check() && auth()->user()->role == 'admin')
                                                    <td class="align-middle text-center">
                                                        <div class="">
                                                            <a href="{{ route('position.show', $item->id) }}"
                                                                
                                                                class="btn btn-sm bg-primary text-white font-weight-bold text-xs"
                                                                data-toggle="tooltip" data-placement="top" title="Detail Posisi">
                                                                <li class="fas fa-eye"></li>
                                                            </a>
                                                            <a href="{{ route('position.edit', $item->id) }}"
                                                                
                                                                class="btn btn-sm bg-warning text-white font-weight-bold text-xs"
                                                                data-toggle="tooltip" data-placement="top" title="Edit Posisi">
                                                                <li class="fas fa-edit"></li>
                                                            </a>
                                                            <form style="display: inline"
                                                                action="{{ url('position/' . $item->id) }}" method="POST">
                                                                @csrf
                                                                @method('DELETE')
                                                                <button type="submit"
                                                                    class="btn btn-sm btn-danger delete-button"
                                                                    id="delete" data-toggle="tooltip" data-placement="top" title="Hapus Posisi">
                                                                    <li class="fas fa-trash"></li>
                                                                </button>
                                                            </form>

                                                        </div>
                                                    </td>
                                                @endif
                                                @if (auth()->check() && auth()->user()->role == 'user')
                                                    <td class="align-middle text-center">
                                                        <div class="">
                                                            <a
                                                                href="{{ '/position/' . $item->id }}"
                                                                class="btn btn-sm bg-primary text-white font-weight-bold text-xs"
                                                                data-toggle="tooltip" data-original-title="Edit Posisi">
                                                                <i class="fas fa-eye"></i>
                                                            </a>


                                                        </div>
                                                    </td>
                                                @endif
                                            </tr>
                                        @endforeach --}}
                                    </tbody>
                                </table>
                                </div>
                            </div>
                            <!-- /.card-body -->
                            {{-- <div class="card-footer clearfix">
                                <ul class="pagination pagination-sm m-0 float-right">
                                    <li class="page-item {{ $positions->onFirstPage() ? 'disabled' : '' }}">
                                        <a class="page-link" href="{{ $positions->previousPageUrl() }}">&laquo;</a>
                                    </li>
                                    @for ($i = 1; $i <= $positions->lastPage(); $i++)
                                        <li class="page-item {{ $i == $positions->currentPage() ? 'active' : '' }}">
                                            <a class="page-link" href="{{ $positions->url($i) }}">{{ $i }}</a>
                                        </li>
                                    @endfor
                                    <li
                                        class="page-item {{ $positions->currentPage() == $positions->lastPage() ? 'disabled' : '' }}">
                                        <a class="page-link" href="{{ $positions->nextPageUrl() }}">&raquo;</a>
                                    </li>
                                </ul>
                            </div> --}}
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



