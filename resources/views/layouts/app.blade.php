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
    document.addEventListener('DOMContentLoaded', function () {
        const viewer = new Viewer(document.getElementById('cv-link'), {
            inline: false,
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
                    confirmButtonColor: '#3085d6',
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

<script>
    {{-- $(document).ready(function() {
        $('[data-fancybox="gallery"]').fancybox();
    });
</script>  --}}
