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
    document.getElementById('filter-button').addEventListener('click', function() {
        var selectedStatus = document.getElementById('status-filter').value;
        // Redirect to the route with the selected filter status
        window.location.href = '/intern?status=' + selectedStatus;
    });
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
    $(document).ready(function() {
        $('[data-fancybox="gallery"]').fancybox();
    });
</script> --}}



