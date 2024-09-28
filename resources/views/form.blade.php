<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@lang('form.title') - Internship Kadang Koding</title>

    <link rel="shortcut icon" href="{{ asset('img/logo/logo2.png') }}" type="image/x-icon">

    <link rel="stylesheet" href="{{ asset('admin/assets/compiled/css/app.css') }}">
    <link rel="stylesheet" href="{{ asset('admin/assets/compiled/css/app-dark.css') }}">
    <link rel="stylesheet" href="{{ asset('admin/assets/compiled/css/auth.css') }}">
    <link rel="stylesheet" href="{{ asset('admin/assets/extensions/flatpickr/flatpickr.min.css') }}">
</head>

<body>
    <div id="auth">
        <div class="row h-100">
            <div class="col-lg-7 col-12">
                <div id="auth-left">
                    <h1 class="auth-title">@lang('form.sub')</h1>
                    <p class="auth-subtitle mb-5">@lang('form.desc')</p>

                    <form method="POST" action="{{ url('/') }}" enctype="multipart/form-data" id="formRegist">
                        @csrf
                        <div class="row">
                            <div class="col-lg-6">
                                <p for="" class="text-primary">@lang('form.input.nama_lengkap') <span class="text-danger">*</span>
                                </p>

                                <div class="form-group position-relative  mb-4">
                                    <input type="text"
                                        class="form-control form-control @error('full_name') is-invalid @enderror"
                                        name="full_name" placeholder="@lang('form.placeholder.lengkap_')" value="{{ old('full_name') }}">
                                    @error('full_name')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                            </div>
                            <div class="col-lg-6">
                                <p for="" class="text-primary">@lang('form.input.nama_panggilan') <span class="text-danger">*</span>
                                </p>

                                <div class="form-group position-relative  mb-4">
                                    <input type="text"
                                        class="form-control form-control @error('username') is-invalid @enderror"
                                        name="username" placeholder="@lang('form.placeholder.panggilan')">
                                    @error('username')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                            </div>
                            <div class="col-lg-6">
                                <p for="" class="text-primary">@lang('form.input.no')<span class="text-danger">*</span>
                                </p>

                                <div class="form-group position-relative has-icon-right mb-4">
                                    <input type="text"
                                        class="form-control form-control @error('phone_number') is-invalid @enderror"
                                        name="phone_number" placeholder="@lang('form.placeholder.no')" value="{{ old('phone_number') }}">
                                    <div class="form-control-icon px-3">
                                        <i class="bi bi-telephone"></i>
                                    </div>
                                    @error('phone_number')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                            </div>
                            <div class="col-lg-6">
                                <p for="" class="text-primary">@lang('form.input.jk')
                                    <span class="text-danger">*</span>
                                </p>
                                <div class="form-group position-relative has-icon-right mb-4">
                                    <select class="form-control form-control @error('gender') is-invalid @enderror"
                                        name="gender" placeholder="@lang('form.placeholder.no')" value="{{ old('gender') }}">
                                        <option value="" selected disabled>@lang('form.placeholder.jk')</option>
                                        <option value="male" {{ old('gender') == 'male' ? 'selected' : '' }}>
                                            @lang('form.input.lk')
                                        </option>
                                        <option value="female" {{ old('gender') == 'female' ? 'selected' : '' }}>
                                            @lang('form.input.pr')
                                        </option>
                                    </select>
                                    <div class="form-control-icon px-3">
                                        <i class="bi bi-gender-neuter"></i>
                                    </div>
                                    @error('phone_number')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                            </div>
                            <p for="" class="text-primary">@lang('form.input.email') <span class="text-danger">*</span></p>

                            <div class="col-lg-12">
                                <div class="form-group position-relative has-icon-right mb-4">
                                    <input type="email"
                                        class="form-control form-control @error('email') is-invalid @enderror"
                                        name="email" placeholder="@lang('form.placeholder.email')" value="{{ old('email') }}">
                                    <div class="form-control-icon px-3">
                                        <i class="bi bi-envelope"></i>
                                    </div>
                                    @error('email')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                            </div>
                            <p for="" class="text-primary">@lang('form.input.alamat') <span class="text-danger">*</span></p>

                            <div class="col-lg-12">
                                <div class="form-group position-relative has-icon-right mb-4">
                                    <textarea type="text" class="form-control form-control @error('address') is-invalid @enderror" name="address"
                                        placeholder="@lang('form.placeholder.alamat')" value="{{ old('address') }}"></textarea>
                                    <div class="form-control-icon px-3">
                                        <i class="bi bi-house"></i>
                                    </div>
                                    @error('address')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                            </div>
                            <hr>
                            <div class="col-lg-6">
                                <p for="" class="text-primary">@lang('form.input.asal') <span
                                        class="text-danger">*</span></p>

                                <div class="form-group position-relative has-icon-right mb-4">

                                    <input type="text"
                                        class="form-control form-control @error('school') is-invalid @enderror"
                                        name="school" placeholder="@lang('form.placeholder.asal')" value="{{ old('school') }}">
                                    <div class="form-control-icon px-3">
                                        <i class="bi bi-backpack"></i>
                                    </div>
                                    @error('school')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                            </div>
                            <div class="col-lg-6">
                                <p for="" class="text-primary">@lang('form.input.jurusan') <span class="text-danger">*</span></p>

                                <div class="form-group position-relative has-icon-right mb-4">
                                    <input type="text"
                                        class="form-control form-control @error('major') is-invalid @enderror"
                                        name="major" placeholder="@lang('form.placeholder.major')" value="{{ old('major') }}">
                                    <div class="form-control-icon px-3">
                                        <i class="bi bi-mortarboard"></i>
                                    </div>
                                    @error('major')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                            </div>

                            <hr>
                            <p for="" class="text-primary">@lang('form.input.posisi') <span class="text-danger">*</span>
                            </p>

                            <div class="col-lg-12">

                                <div class="form-group position-relative has-icon-right mb-4">
                                    <select name="position_id" class="form-control form-control"
                                        {{ $selectedPosition ? 'readonly' : '' }} required>
                                        @if ($selectedPosition)
                                            <option value="{{ $selectedPosition->id }}"
                                                {{ $selectedPosition ? 'selected' : '' }}>
                                                {{ $selectedPosition->name }}</option>
                                        @else
                                            <option value="" selected disabled>@lang('form.placeholder.posisi')</option>
                                            @foreach ($activePositions as $activePosition)
                                                <option value="{{ $activePosition->id }}">{{ $activePosition->name }}
                                                </option>
                                            @endforeach
                                        @endif
                                    </select>
                                    <div class="form-control-icon px-3">
                                        <i class="bi bi-briefcase"></i>
                                    </div>
                                    @error('address')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                            </div>
                            <div class="col-lg-6">
                                <p for="" class="text-primary">@lang('form.input.tanggal_mulai') <span
                                        class="text-danger">*</span></p>

                                <div class="form-group position-relative  mb-4">

                                    <input type="date" name="start_date" class="form-control mb-3 flatpickr-no-config @error('start_date') is-invalid @enderror" placeholder="@lang('form.placeholder.mulai')" id="start_date">

                                    @error('start_date')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                            </div>

                            <div class="col-lg-6">
                                <p for="" class="text-primary">@lang('form.input.tanggal_selesai') <span
                                        class="text-danger">*</span></p>

                                <div class="form-group position-relative mb-4">
                                    <input type="date" name="end_date" class="form-control mb-3 flatpickr-no-config @error('end_date') is-invalid @enderror" placeholder="@lang('form.placeholder.selesai')" id="end_date">

                                    @error('end_date')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                            </div>
                            <hr>
                            <p for="" class="text-primary">@lang('form.input.cv') <span class="text-danger">*</span></p>
                            <div class="col-lg-12">
                                <div class="form-group position-relative has-icon-right mb-4">
                                    <input type="file" id="fileCV"
                                        class="form-control form-control @error('cv') is-invalid @enderror"
                                        name="cv" placeholder="cv" value="{{ old('cv') }}"
                                        accept=".pdf, .docx, .png, .jpg, .jpeg">
                                    @error('cv')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                            </div>
                            <p for="" class="text-primary">@lang('form.input.motivation') <span class="text-danger">*</span></p>
                            <div class="col-lg-12">
                                <div class="form-group position-relative has-icon-right mb-4">
                                    <input type="file" id="fileMotivation"
                                        class="form-control form-control @error('motivation_letter') is-invalid @enderror"
                                        name="motivation_letter" value="{{ old('motivation_letter') }}"
                                        accept=".pdf, .docx, .png">
                                    @error('motivation_letter')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                            </div>
                            <p for="" class="text-primary">@lang('form.input.surat')</p>
                            <div class="col-lg-12">
                                <div class="form-group position-relative has-icon-right mb-4">
                                    <input type="file"
                                        class="form-control form-control @error('cover_letter') is-invalid @enderror"
                                        value="{{ old('cover_letter') }}" id="fileSurat" name="cover_letter"
                                        accept=".pdf, .docx, .png, .jpg, .jpeg">
                                    @error('cover_letter')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                            </div>
                            <p for="" class="text-primary">@lang('form.input.portfolio') <span class="text-danger">*</span></p>
                            <div class="col-lg-12">
                                <div class="form-group position-relative has-icon-right mb-4">
                                    <input type="file"
                                        class="form-control form-control @error('portfolio') is-invalid @enderror"
                                        value="{{ old('portfolio') }}" id="filePortfolio" name="portfolio"
                                        accept=".pdf, .docx, .png, .jpg, .jpeg">
                                    @error('portfolio')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                            </div>
                            <p for="" class="text-primary">@lang('form.input.pas') <span class="text-danger">*</span></p>
                            <div class="col-lg-12">
                                <div class="form-group position-relative has-icon-right mb-4">
                                    <input type="file"
                                        class="form-control form-control @error('photo') is-invalid @enderror"
                                        value="{{ old('photo') }}" id="filefoto" name="photo"
                                        accept=".jpg, .jpeg, .png, .webp">
                                    @error('photo')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                            </div>
                            <div class="form-group" hidden>

                                <label for="example-text-input" class="form-control-label">messages<span
                                        class="text-danger"> *</span></label>

                                <textarea class="form-control @error('messages') is-invalid @enderror" type="text" value=""
                                    name="messages" placeholder="Masukkan Alamat">Terimakasih telah mendaftarkan diri magang di Kadang Koding Indonesia. Data anda sedang kami proses.</textarea>

                                @error('messages')
                                    <div class="invalid-feedback">{{ $message }}

                                    </div>
                                @enderror

                            </div>
                            <div class="form-group" hidden>
                                <input class="form-control invisible" value="pending" id="status" name="status">
                            </div>
                        </div>
                        <input type="hidden" name="periode_id" value="{{ $periode->id }}">

                        <button type="submit" id="submitButton"
                            class="btn btn-primary btn-block btn-lg shadow-lg mt-5">@lang('form.btn')</button>
                    </form>
                </div>
            </div>
            <div class="col-lg-5 d-none d-lg-block">
                <div id="auth-right">

                </div>
            </div>
        </div>

    </div>
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.min.js"></script>
    <script src="{{ asset('admin/assets/extensions/flatpickr/flatpickr.min.js') }}"></script>
    <script src="{{ asset('admin/assets/static/js/pages/date-picker.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        $(document).ready(function() {
            $('select[name="position_id"]').on('change', function() {
                var positionId = $(this).val();

                $.ajax({
                    url: '{{ route('get.periode.id', ':positionId') }}'.replace(':positionId',
                        positionId),
                    type: 'GET',

                    success: function(response) {
                        $('input[name="periode_id"]').val(response.periode_id);
                    },
                    error: function(error) {
                        console.log(error);
                    }
                });
            });
        });
    </script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var startDateInput = document.getElementById('start_date');
            var endDateInput = document.getElementById('end_date');
            var today = new Date();

            today.setHours(0, 0, 0, 0);

            endDateInput.addEventListener('change', function() {
                var startDate = new Date(startDateInput.value);
                var endDate = new Date(endDateInput.value);

                if (startDate > endDate) {

                    Swal.fire({
                        icon: 'error',
                        title: 'Oopss...',
                        text: 'Tanggal selesai harus setelah tanggal mulai',
                        confirmButtonText: 'Ok',
                        confirmButtonColor: "#435EBE",
                        cancelButtonColor: "#CDD3D8",
                    });

                    endDateInput.value = '';
                } else if (endDate < today) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Oopss...',
                        text: 'Tanggal selesai tidak boleh kurang dari tanggal hari Ini',
                        confirmButtonText: 'Ok',
                        confirmButtonColor: "#435EBE",
                        cancelButtonColor: "#CDD3D8",

                    });
                    endDateInput.value = '';

                }

            });


            startDateInput.addEventListener('change', function() {

                var startDate = new Date(startDateInput.value);
                if (startDate < today) {

                    Swal.fire({
                        icon: 'error',
                        title: 'Oopss...',
                        text: 'Tanggal mulai tidak boleh kurang dari tanggal hari Ini',
                        confirmButtonText: 'Ok',
                        confirmButtonColor: "#435EBE",
                        cancelButtonColor: "#CDD3D8",

                    });
                    startDateInput.value = '';

                }

            });

        });
    </script>



    <script>
        $(document).ready(function() {
            $("#formRegist").on("submit", function(e) {
                e.preventDefault();

                Swal.fire({
                    title: 'Mohon Tunggu!',
                    html: 'Sedang memproses data...',
                    allowOutsideClick: false,
                    showConfirmButton: false,
                    willOpen: () => {
                        Swal.showLoading();
                    },
                });

                $.ajax({
                    type: 'POST',
                    url: '{{ route('register.store') }}',
                    data: new FormData(this),
                    processData: false,
                    contentType: false,
                    success: function(response) {
                        Swal.close();

                        if (response.success) {
                            Swal.fire({
                                icon: 'success',
                                title: 'Berhasil!',
                                text: 'Selamat! Pendaftaran Anda berhasil disimpan. Mohon periksa email Anda (baik di Inbox maupun folder spam) untuk langkah selanjutnya.',
                            }).then(function() {
                                window.location.href = '{{ url('/') }}';
                            });
                        } else {
                            if (response.errors) {
                                var errorMessages = '';
                                for (var key in response.errors) {
                                    if (response.errors.hasOwnProperty(key)) {
                                        errorMessages += response.errors[key][0] + '<br>';
                                    }
                                }
                                Swal.fire('Gagal', errorMessages, 'error');
                            } else {
                                Swal.fire('Gagal', 'Terjadi kesalahan saat menyimpan data',
                                    'error');
                            }
                        }
                    },
                    error: function(xhr) {
                        Swal.close();
                        if (xhr.status === 422) {
                            var errorMessages = '';
                            var errors = xhr.responseJSON.errors;
                            for (var key in errors) {
                                if (errors.hasOwnProperty(key)) {
                                    errorMessages += errors[key][0] + '<br>';
                                }
                            }
                            Swal.fire('Gagal', errorMessages, 'error');
                        } else {
                            Swal.fire('Gagal', 'Terjadi kesalahan saat simpan data.', 'error');
                        }
                    },
                });
            });
        });
    </script>
</body>

</html>
