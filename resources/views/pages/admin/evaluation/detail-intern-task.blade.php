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
                <h3>Daftar Tugas</h3>
                <p class="text-subtitle text-muted">Berikut daftar Tugas Maganger </p>
            </div>
            <div class="col-12 col-md-6 order-md-2 order-first">
                <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('evaluations.index') }}">Penilaian</a></li>
                        <li class="breadcrumb-item active" aria-current="page">{{ $interns->full_name }}</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>

    <div class="content-wrapper">
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                </div>
            </div>
        </section>
        <section class="section mt-2">

            <div class="row">
                @php
                    $totalWeight = 0;
                    $taskNames = [];
                @endphp

                @foreach ($tasks as $task)
                    @php
                        // Menambahkan bobot tugas ke totalWeight
                        $totalWeight += $task->weight;

                        // Menyimpan nama tugas
                        $taskNames[] = $task->name;
                    @endphp
                    <div class="col-md-4">
                        <a
                            href="{{ route('evaluations.detail.task', ['internId' => $interns->id, 'taskId' => $task->id]) }}">
                            <div class="card">
                                <div class="card-body">
                                    <h5>{{ $task->name }}</h5>
                                    <p>{{ rtrim(rtrim($task->weight, '0'), '.') }} %</p>
                                    <hr>
                                    <div class="d-flex">
                                        <p class="me-2">{{ $task->has_technical_aspects ? 'Aspek Teknis' : '' }} </p>
                                        @if ($task->has_non_technical_aspects)
                                            <p class="me-2">|</p>
                                        @endif
                                        <p>{{ $task->has_non_technical_aspects ? 'Aspek Non Teknis' : '' }}</p>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                @endforeach

                <div class="col-md-4">
                    <a href="{{ route('evaluations.final.score', ['internId' => $interns->id]) }}">
                        <div class="card">
                            <div class="card-body">
                                <h5>Nilai Akhir</h5>
                                <p class="me-2"> {{ $totalWeight }} %</p>
                                <hr>
                                <div class="d-flex">
                                    <p class="me-2">{{ implode(' | ', $taskNames) }}</p>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>

            </div>
        </section>
    @endsection
