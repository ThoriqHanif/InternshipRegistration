@include('layouts.header')

<body>
    <script src="{{ asset('admin/assets/static/js/initTheme.js') }}"></script>
    <div id="app">
        @include('layouts.sidebar')
        <div id="main">
            @yield('content')


            @include('layouts.footer')
        </div>
    </div>

    <script src="{{ asset('admin/assets/static/js/components/dark.js') }}"></script>
    <script src="{{ asset('admin/assets/extensions/perfect-scrollbar/perfect-scrollbar.min.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    {{-- <link rel="stylesheet" href="{{ asset('admin/assets/extensions/summernote/summernote-lite.css') }}"> --}}

    {{-- <link rel="stylesheet" href="{{ asset('admin/assets/compiled/css/form-editor-summernote.css') }}"> --}}

    <script src="{{ asset('admin/assets/compiled/js/app.js') }}"></script>
    <script src="{{ asset('admin/assets/extensions/choices.js/public/assets/scripts/choices.js') }}"></script>
    <script src="{{ asset('admin/assets/extensions/flatpickr/flatpickr.min.js') }}"></script>
    <script src="{{ asset('admin/assets/static/js/pages/date-picker.js') }}"></script>
    <script src="{{ asset('admin/assets/static/js/pages/form-element-select.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

    {{-- DATATABLES --}}
    <script
        src="https://cdn.datatables.net/v/bs5/jszip-3.10.1/dt-1.13.7/b-2.4.2/b-html5-2.4.2/b-print-2.4.2/r-2.5.0/datatables.min.js">
    </script>
    <script src="https://cdn.datatables.net/buttons/2.4.2/js/dataTables.buttons.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.4.2/js/buttons.html5.min.js"></script>
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

    {{-- <script>
        document.addEventListener('DOMContentLoaded', function() {
            var startDateInput = document.getElementById('start_date');
            var endDateInput = document.getElementById('end_date');

            endDateInput.addEventListener('change', function() {
                var startDate = new Date(startDateInput.value);
                var endDate = new Date(endDateInput.value);

                if (startDate > endDate) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Kesalahan',
                        text: 'Tanggal Selesai harus setelah Tanggal Mulai',
                        confirmButtonText: 'Ok',
                        confirmButtonColor: "#435EBE",
                        cancelButtonColor: "#CDD3D8",
                    });

                    endDateInput.value = '';
                }
            });
        });
    </script> --}}

    @stack('script-dashboard')
    @stack('table-intern')
    @stack('table-position')
    @stack('table-periode')
    @stack('table-user')
    @stack('table-blog')
    @stack('table-tag')
    @stack('table-sosmed')
    @stack('table-blog-categories')
    @stack('table-report-intern')
    @stack('table-evaluations')
    @stack('table-subscriptions')
    @stack('show-modal-report')
    @stack('script-report')
    @stack('script-blog')
    @stack('script-blog-form')
    @stack('script-blog-preview')
    @stack('script-edit-intern')
    @stack('script-sosmed')


</body>
