@extends('layouts.app')

@section('content')
    <header class="mb-3">
        <a href="#" class="burger-btn d-block d-xl-none">
            <i class="bi bi-justify fs-3"></i>
        </a>
    </header>
    <div class="page-title">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h3>Komentar</h3>
                <p class="text-subtitle text-muted">Daftar Komentar dari Blog Anda</p>
            </div>
            <div class="col-12 col-md-6 order-md-2 order-first">
                <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item active" aria-current="page">Komentar</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>

    @include('pages.users.comment.reply')

    <section class="section">
        @foreach ($blogs as $blog)
            <div class="card">
                <div class="card-header d-flex justify-content-between">
                    <h4 class="card-title"><a
                            href="{{ route('home.blog.detail', ['locale' => app()->getLocale(), 'slug' => app()->getLocale() == 'en' && $blog->slug_en ? $blog->slug_en : $blog->slug]) }}">{{ $blog->title }}
                        </a> | {{ $blog->author->name }}</h4>
                    <a href="{{ route('comments.show', ['slug' => $blog->slug]) }}">View All</a>
                </div>
                <div class="card-body">
                    @foreach ($blog->comments->take(2) as $comment)
                        <div class="comment">
                            <div class="comment-header">
                                <div class="pr-50">
                                    <div class="avatar avatar-2xl">
                                        <img
                                            src="{{ isset($comment->user) && $comment->user->intern ? asset('uploads/photo/' . $comment->user->intern->photo) : asset('uploads/photo/default-user.jpg') }}"alt="Avatar">
                                    </div>
                                </div>
                                <div class="comment-body">
                                    <div class="comment-profileName">
                                        <strong> {{ $comment->name }} </strong>
                                        @if ($comment->parent_id)
                                            membalas komentar {{ $comment->parent->name ?? '' }}
                                        @else
                                            berkomentar pada {{ $comment->blog->title }}
                                        @endif
                                    </div>
                                    <div class="comment-time">{{ $comment->created_at->diffForHumans() }}</div>
                                    <div class="comment-message">
                                        <p class="list-group-item-text truncate mb-20">
                                            "{{ $comment->message }}"
                                        </p>
                                    </div>
                                    <div class="comment-actions">
                                        <button class="btn icon icon-left btn-primary me-2 text-nowrap btn-reply"
                                            data-bs-toggle="modal" data-bs-target="#replyComment"
                                            data-blog-id="{{ $comment->blog_id }}"
                                            data-comment-id="{{ $comment->id }}"
                                            data-message="{{ $comment->message }}"
                                            data-comment-name="{{ $comment->name }}">
                                            <i class="bi bi-reply mb-2"></i> Reply
                                        </button>
                                        {{-- <button class="btn icon icon-left btn-warning me-2 text-nowrap"><i
                                                class="bi bi-pencil-square"></i> Edit</button> --}}
                                        <form style="display: inline"
                                            action="{{ route('comments.destroy', $comment->id) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                class="btn icon icon-left btn-danger me-2 text-nowrap remove-button"><i
                                                    class="bi bi-x-circle"></i> Remove</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        @endforeach


    </section>

    @push('script-comments')
        {{-- Delete --}}
        <script>
            $(document).ready(function() {
                $('.remove-button').on('click', function(e) {
                    e.preventDefault();
                    var deleteButton = $(this);
                    Swal.fire({
                        title: 'Konfirmasi Hapus',
                        text: 'Anda yakin ingin menghapus komentar ini?',
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
                                html: 'Sedang menghapus data...',
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
                                            text: 'Data berhasil dihapus.',
                                            confirmButtonColor: "#435EBE",
                                            cancelButtonColor: "#CDD3D8",
                                        }).then(function() {
                                            window.location.reload();
                                        });
                                    } else {
                                        Swal.fire('Gagal', 'Gagal menghapus data', 'error');

                                    }
                                },
                                error: function() {
                                    Swal.close();

                                    Swal.fire('Gagal',
                                        'Terjadi kesalahan saat menghapus data',
                                        'error');
                                }
                            });
                        }
                    });
                });
            });
        </script>

        {{-- Passing Data --}}
        <script>
            document.addEventListener('DOMContentLoaded', function () {
                const replyButtons = document.querySelectorAll('.btn-reply');

                replyButtons.forEach(button => {
                    button.addEventListener('click', function () {
                        const blogId = this.getAttribute('data-blog-id');
                        const commentId = this.getAttribute('data-comment-id');
                        const commentName = this.getAttribute('data-comment-name');
                        const commentMessage = this.getAttribute('data-message');

                        document.getElementById('data-blog-id').value = blogId;
                        document.getElementById('data-parent-id').value = commentId;
                        document.getElementById('data-comment-name').innerText = commentName;
                        document.getElementById('data-message').innerText = commentMessage;
                    });
                });
            });
        </script>

        <script>
            document.addEventListener('DOMContentLoaded', function() {
                $('.btn-reply').on('click', function() {
                    var commentId = $(this).data('comment-id');
                    var commentMessage = $(this).data('comment-message');

                    $('#formReplyComment input[name="parent_id"]').val(commentId);
                    $('#formReplyComment textarea[name="message"]').val('');
                    $('#formReplyComment textarea[name="name"]').val(commentMessage);
                });
            });
        </script>
        {{-- Create --}}
        <script>
            $(document).ready(function() {
                $("#formReplyComment").on("submit", function(e) {
                    e.preventDefault();
                    $('#replyComment').modal('hide');

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
                        url: '{{ route('comments.store') }}',
                        data: new FormData(this),
                        processData: false,
                        contentType: false,
                        success: function(response) {
                            Swal.close();

                            if (response.success) {
                                $('#formReplyComment')[0].reset();
                                Swal.fire({
                                    icon: 'success',
                                    title: 'Berhasil!',
                                    text: 'Data berhasil disimpan.',
                                    confirmButtonColor: "#435EBE",
                                    cancelButtonColor: "#CDD3D8",
                                }).then(function() {
                                    window.location.reload();
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
                                    Swal.fire('Gagal', 'Terjadi kesalahan saat memperbarui data',
                                        'error');
                                }
                            }
                        },
                        error: function(xhr) {
                            Swal.close();
                            if (xhr.status === 422) {
                                // Menampilkan pesan validasi error SweetAlert
                                var errorMessages = '';
                                var errors = xhr.responseJSON.errors;
                                for (var key in errors) {
                                    if (errors.hasOwnProperty(key)) {
                                        errorMessages += errors[key][0] + '<br>';
                                    }
                                }
                                Swal.fire('Gagal', errorMessages, 'error');
                            } else {
                                Swal.fire('Gagal', 'Terjadi kesalahan saat update data.', 'error');
                            }
                        },
                    });
                });
            });
        </script>


    @endpush
@endsection
