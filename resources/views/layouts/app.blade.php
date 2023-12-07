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

@stack('table-intern')
@stack('table-position')
@stack('table-periode')
@stack('table-user')
@stack('show-modal-report')
@stack('script-report')
@stack('script-edit-intern')
@stack('table-report-intern')

{{-- <script>
    let tableReport = new DataTable('#tableReport', {
        dom: 'Bfrtip',
        buttons: ['copy', 'csv', 'excel', 'pdf', 'print'],
        
        processing: true,
        serverSide: true,
        responsive: true,

        ajax: {
            url: "{{ route('reports.index') }}",
        },

        columns: [{
                data: 'DT_RowIndex',
                name: 'DT_RowIndex',
                orderable: false,
                searchable: false
            },
            {
                data: 'date',
                name: 'date'
            },
            {
                data: 'presence',
                name: 'presence'
            },
            {
                data: 'attendance_hours',
                name: 'attendance_hours'
            },
            {
                data: 'agency',
                name: 'agency'
            },
            {
                data: 'project_name',
                name: 'project_name'
            },
            {
                data: 'job',
                name: 'job'
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
</script> --}}

{{-- <script>
    // Inisialisasi Fancybox
    $(document).ready(function() {
        $("[data-fancybox]").fancybox();
    });
</script> --}}

{{-- <script>
    $(function() {
        $('[data-toggle="tooltip"]').tooltip()
    })
</script> --}}




