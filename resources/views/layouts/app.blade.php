@include('layouts.header')

@include('layouts.navbar')

@include('layouts.sidebar')

@yield('content')

@include('layouts.footer')

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script type="text/javascript">
    const deleteButtons = document.querySelectorAll('.delete-button');

    deleteButtons.forEach(button => {
        button.addEventListener('click', (e) => {
            e.preventDefault();

            // Tampilkan SweetAlert2 konfirmasi
            Swal.fire({
                title: 'Apakah Anda yakin?',
                text: "Anda tidak akan dapat mengembalikan data ini!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Ya, Hapus!',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    // Jika pengguna mengonfirmasi, submit form penghapusan
                    e.target.closest('form').submit();
                }
            });
        });
    });
</script>


<script>
    // Inisialisasi Fancybox
    $(document).ready(function() {
        $("[data-fancybox]").fancybox();
    });
</script>

<script>
    const viewer = new Viewer(document.querySelector('a'));
</script>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const viewer = new Viewer(document.getElementById('cv-link'), {
            inline: false,
        });
    });
</script>

<script>
    let tableUser = new DataTable('#tableUser', {
        processing: true,
        serverSide: true,
        responsive: true,
        ajax: {
            url: "{{ route('users.index') }}"
        },
        columns: [{
                data: 'DT_RowIndex',
                name: 'DT_RowIndex',
                orderable: false,
                searchable: false
            },
            {
                data: 'name',
                name: 'name'
            },
            {
                data: 'email',
                name: 'email'
            },
            {
                data: 'role',
                name: 'role'
            },
            {
                data: 'action',
                name: 'action'
            },


        ]
    });
</script>

<script>
    let tablePeriode = new DataTable('#tablePeriode', {
        processing: true,
        serverSide: true,
        responsive: true,
        ajax: {
            url: "{{ route('periode.index') }}"
        },
        columns: [{
                data: 'DT_RowIndex',
                name: 'DT_RowIndex',
                orderable: false,
                searchable: false
            },
            {
                data: 'name',
                name: 'name'
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
                data: 'quota',
                name: 'quota'
            },
            {
                data: 'description',
                name: 'description'
            },
            {
                data: 'action',
                name: 'action'
            },


        ]
    });
</script>

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

<script>
    function showDeletedIntern() {
        // Mengubah URL Ajax yang digunakan untuk mengambil data intern yang sudah dihapus
        tableIntern.ajax.url("{{ route('intern.index') }}?showDeleted=1&status=" + $('#statusFilter').val()).load();

        // Mengganti teks tombol "Lihat Arsip" menjadi "Lihat Semua"
        document.getElementById("showDeletedButtonIntern").innerHTML = "Lihat Semua";

        // Mengganti atribut onclick tombol "Lihat Arsip" agar dapat membatalkan tampilan data yang dihapus
        document.getElementById("showDeletedButtonIntern").setAttribute("onclick", "showAllIntern()");
    }

    function showAllIntern() {
        // Mengembalikan URL Ajax ke pengaturan semula (tanpa menampilkan data yang dihapus)
        tableIntern.ajax.url("{{ route('intern.index') }}?showDeleted=0&status=" + $('#statusFilter').val()).load();

        // Mengganti teks tombol "Lihat Semua" kembali menjadi "Lihat Arsip"
        document.getElementById("showDeletedButtonIntern").innerHTML =
            '<i id="showDeletedIcon" class="fas fa-trash mr-2"></i> Lihat Data Terhapus';

        // Mengganti atribut onclick tombol "Lihat Semua" agar dapat memanggil kembali fungsi showDeletedIntern()
        document.getElementById("showDeletedButtonIntern").setAttribute("onclick", "showDeletedIntern()");
    }

    let tableIntern = new DataTable('#tableIntern', {
        processing: true,
        serverSide: true,
        responsive: true,
        ajax: {
            url: "{{ route('intern.index') }}",
            data: function(d) {
                d.showDeleted = $('#showDeletedButtonIntern').data('show-deleted');
                d.status = $('#statusFilter').val(); // Menambahkan filter status ke data yang dikirimkan
            }
        },
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
    });

    // Event handler untuk filter status
    $('#statusFilter').change(function() {
        tableIntern.ajax.reload(); // Memuat ulang data dengan filter status baru
    });
</script>


<script></script>



<!-- Include jQuery and Bootstrap Datepicker (Adjust the paths accordingly) -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap-datepicker@1.9.0/dist/js/bootstrap-datepicker.min.js"></script>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Dapatkan elemen input tanggal mulai dan tanggal selesai
        var startDateInput = document.getElementById('start_date');
        var endDateInput = document.getElementById('end_date');

        // Tambahkan event listener pada perubahan input tanggal selesai
        endDateInput.addEventListener('change', function() {
            // Parse tanggal mulai dan tanggal selesai ke dalam objek Date
            var startDate = new Date(startDateInput.value);
            var endDate = new Date(endDateInput.value);

            // Bandingkan tanggal dan lakukan validasi
            if (startDate > endDate) {
                Swal.fire({
                    icon: 'error',
                    title: 'Kesalahan',
                    text: 'Tanggal Selesai harus setelah Tanggal Mulai',
                    confirmButtonText: 'Ok'
                });

                endDateInput.value = '';
            }
        });
    });
</script>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        var urlParams = new URLSearchParams(window.location.search);
        var selectedStatus = urlParams.get('status');
        var statusFilter = document.getElementById('status-filter');
        if (selectedStatus) {
            statusFilter.value = selectedStatus;
        }

        // Handle filter when "Cari" button is clicked
        document.getElementById('filter-button').addEventListener('click', function() {
            var selectedStatus = statusFilter.value;
            // Redirect to the route with the selected filter status
            window.location.href = '/intern?status=' + selectedStatus;
        });

        // Handle reset when "Reset" button is clicked
        document.getElementById('reset-button').addEventListener('click', function() {
            // Redirect to the route without any filter status
            window.location.href = '/intern';
        });
    });
</script>


<script>
    $(function() {
        $('[data-toggle="tooltip"]').tooltip()
    })
</script>

<!-- Pastikan Anda telah memasang jQuery dan FancyBox di proyek Anda -->
{{-- <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="{{ asset('js/jquery.fancybox.min.js') }}"></script>

<script>
    $(document).ready(function() {
        // Tambahkan event handler saat tautan "Lihat CV" diklik
        $(".view-cv").on("click", function(e) {
            e.preventDefault(); // Mencegah tautan mengarahkan ke URL aslinya
            var cvUrl = $(this).attr("href"); // Dapatkan URL CV dari tautan

            // Buka CV dalam FancyBox
            $.fancybox.open({
                src: cvUrl,
                type: "iframe", // Gunakan iframe untuk menampilkan PDF, DOCX, dan PNG
                iframe: {
                    css: {
                        width: "80%",
                        height: "80%"
                    }
                }
            });
        });
    });
</script>



{{-- <script>
    $(document).ready(function() {
        $("[data-fancybox]").fancybox({
            type: 'iframe',
            iframe: {
                preload: false // Opsional, gunakan jika Anda ingin memuat iframe hanya ketika dibuka
            }
        });
    });
</script> --}}
