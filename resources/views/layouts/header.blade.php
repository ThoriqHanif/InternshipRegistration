<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Internship Kadang Koding</title>

    <link rel="shortcut icon" href="{{ asset('img/logo/logo2.png') }}" type="image/x-icon">

    <!-- Google Font: Source Sans Pro -->
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="{{ asset('css/custom.css') }}">
    <link rel="stylesheet" href="{{ asset('admin/assets/compiled/css/app.css') }}">
    <link rel="stylesheet" href="{{ asset('admin/assets/compiled/css/app-dark.css') }}">
    <link rel="stylesheet" href="{{ asset('admin/assets/compiled/css/iconly.css') }}">
    <link rel="stylesheet"
        href="{{ asset('admin/assets/extensions/datatables.net-bs5/css/dataTables.bootstrap5.min.css') }}">
    <link rel="stylesheet" href="{{ asset('admin/assets/compiled/css/table-datatable-jquery.css') }}">
    <link rel="stylesheet" href="{{ asset('admin/assets/extensions/summernote/summernote-lite.css') }}">
    <link rel="stylesheet" href="{{ asset('admin/assets/extensions/choices.js/public/assets/styles/choices.css') }}">

    <link rel="stylesheet" href="{{ asset('admin/assets/compiled/css/form-editor-summernote.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/jquery.fancybox.min.css') }}">

    <link rel="stylesheet" href="{{ asset('admin/assets/extensions/flatpickr/flatpickr.min.css') }}">

    {{-- TinyMCE --}}
    <script src="https://cdn.tiny.cloud/1/tf6ty59pa2sp13z8x7ly4s8jt0uwn84w0ea98x6drs5nhhjr/tinymce/7/tinymce.min.js" referrerpolicy="origin"></script>


    <!-- jQuery -->
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <!-- Fancybox -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/fancyapps/fancybox@3.5.7/dist/jquery.fancybox.min.css" />
    <script src="https://cdn.jsdelivr.net/gh/fancyapps/fancybox@3.5.7/dist/jquery.fancybox.min.js"></script>

    <!-- DataTables -->
    <link rel="stylesheet"
        href="https://cdn.datatables.net/v/bs5/jszip-3.10.1/dt-1.13.7/b-2.4.2/b-html5-2.4.2/b-print-2.4.2/r-2.5.0/datatables.min.css">
    <script src="{{ asset('admin/assets/extensions/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('admin/assets/extensions/datatables.net/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('admin/assets/extensions/datatables.net-bs5/js/dataTables.bootstrap5.min.js') }}"></script>
    <script src="{{ asset('admin/assets/static/js/pages/datatables.js') }}"></script>
    <script src="{{ asset('admin/assets/compiled/js/app.js') }}"></script>

    {{-- <link href="{{ asset('assets/css/icons.min.css') }}" rel="stylesheet" type="text/css" />x --}}
    {{-- Select2 --}}
</head>
