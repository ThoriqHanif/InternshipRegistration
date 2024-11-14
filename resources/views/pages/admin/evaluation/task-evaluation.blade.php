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
                <h3>Penilaian</h3>
                <p class="text-subtitle text-muted">Kelola Penilaian {{ $tasks->name }} </p>
            </div>
            <div class="col-12 col-md-6 order-md-2 order-first">
                <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('evaluations.index') }}">Penilaian</a></li>
                        <li class="breadcrumb-item active" aria-current="page"><a
                                href="{{ route('evaluations.show', $interns->id) }}">{{ $interns->full_name }}</a></li>
                        <li class="breadcrumb-item active" aria-current="page">{{ $tasks->name }}</li>
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
            <form action="{{ route('evaluations.store') }}" method="POST" id="formEvaluation">
                @csrf
                <div class="card" style="margin-bottom: 10px !important;">
                    <div class="card-body" style="padding-bottom: 5px !important;">
                        <div class="row">
                            <div class="col-6">
                                <table class="table table-borderless">
                                    <tr>
                                        <th>Nama Pemagang : </th>
                                    </tr>
                                    <tr>
                                        <td>{{ $interns->full_name }}</td>
                                    </tr>
                                </table>
                            </div>
                            <div class="col-6">
                                <table class="table table-borderless">
                                    <tr>
                                        <td class="table-fit">Posisi Magang</td>
                                        <td class="table-fit">:</td>
                                        <th>{{ $interns->position->name }}</th>
                                    </tr>
                                    <tr>
                                        <td class="table-fit">Tugas</td>
                                        <td class="table-fit">:</td>
                                        <th>{{ $tasks->name }}</th>
                                    </tr>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card">
                    <div class="card-header d-flex justify-content-between">
                        <div class="form-group">
                            <label for="">Formulir Penilaian</label>
                        </div>
                        <div class="">
                            <a class="btn btn-primary btn-export-pdf display float-right" id="exportPDF"
                                data-intern-id="{{ $interns->id }}" data-intern-name="{{ $interns->full_name }}"
                                data-task-name="{{ $tasks->name }}">
                                <i class="bi bi-printer-fill mr-2" style="margin-right: 10px"></i>
                                Export PDF
                            </a>
                        </div>
                    </div>
                    <div class="card-body">
                        <input type="hidden" name="intern_id" value="{{ $interns->id }}">
                        <input type="hidden" name="task_id" id="task_id" value="{{ $tasks->id }}">

                        <div class="table-responsive">
                            <table id="evaluationTable" class="table display nowrap" style="width:100%">
                                <thead>
                                    <tr>
                                        <th class="text-center criteria-column">Kriteria</th>
                                        @for ($i = 1; $i <= 10; $i++)
                                            <th class="text-center evaluator-column">Penilai {{ $i }}</th>
                                        @endfor
                                        <th class="score-column">Jumlah</th>
                                        <th class="total-column">Total</th>
                                        <th class="score-column">Rata-rata</th>
                                        <th class="score-column">Nilai Akhir</th>
                                    </tr>
                                    <tr>
                                        <th></th>
                                        @for ($i = 1; $i <= 10; $i++)
                                            <th>
                                                <select name="evaluations[evaluators][{{ $i - 1 }}][evaluator_id]"
                                                    id="evaluations_evaluator_id_{{ $i - 1 }}"
                                                    class="form-select evaluator-select" data-index="{{ $i - 1 }}"
                                                    onchange="">
                                                    <option value="">Pilih Evaluator</option>
                                                    @foreach ($evaluators as $evaluator)
                                                        <option value="{{ $evaluator->id }}"
                                                            @foreach ($evaluation as $eval)
                                                                @if (isset($eval->evaluationDetails[$i - 1]) && $eval->evaluationDetails[$i - 1]->evaluator_id == $evaluator->id)   selected @endif @endforeach>
                                                            {{ $evaluator->name }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </th>
                                        @endfor
                                        <th></th>
                                        <th></th>
                                        <th></th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if ($tasks->has_technical_aspects)
                                        @foreach ($aspects as $aspect)
                                            <tr>
                                                <td>
                                                    <input type="hidden" name="technical[{{ $aspect->id }}][aspect_id]"
                                                        value="{{ $aspect->id }}">
                                                    {{ $aspect->name }}
                                                </td>
                                                @for ($i = 1; $i <= 10; $i++)
                                                    @php
                                                        $evaluation = $technicalEvaluations->get($aspect->id);
                                                    @endphp
                                                    <td>
                                                        <input type="hidden"
                                                            name="technical[{{ $aspect->id }}][evaluators][{{ $i - 1 }}][evaluator_id]"
                                                            id="hidden_evaluator_id_{{ $i - 1 }}"
                                                            class="form-control" value="">
                                                        <input type="number"
                                                            name="technical[{{ $aspect->id }}][evaluators][{{ $i - 1 }}][score]"
                                                            class="form-control" min="40" max="90"
                                                            data-index="{{ $aspect->id }}" data-type="technical"
                                                            placeholder="Score"
                                                            value="{{ isset($evaluation) && isset($evaluation->evaluationDetails[$i - 1]) ? number_format(round($evaluation->evaluationDetails[$i - 1]->score), 0) : '' }}"
                                                            oninput="validateScore(this)">
                                                    </td>
                                                @endfor
                                                <td><input type="number"
                                                        name="technical[{{ $aspect->id }}][total_score]"
                                                        value="{{ isset($evaluation->total_score) ? number_format($evaluation->total_score, 0) : '' }}"
                                                        class="form-control" readonly>
                                                </td>
                                                <td><input type="number"
                                                        name="technical[{{ $aspect->id }}][total_inputted]"
                                                        value="{{ $evaluation->total_inputted ?? '' }}"
                                                        class="form-control" readonly></td>
                                                <td><input type="number"
                                                        name="technical[{{ $aspect->id }}][average_score]"
                                                        value="{{ $evaluation->average_score ?? '' }}"
                                                        class="form-control" readonly></td>
                                                <td><input type="number"
                                                        name="technical[{{ $aspect->id }}][final_score]"
                                                        value="{{ $evaluation->final_score ?? '' }}" class="form-control"
                                                        readonly></td>
                                            </tr>
                                        @endforeach
                                    @endif
                                    @if ($tasks->has_non_technical_aspects)
                                        @foreach ($nonTechnicalAspects as $aspect)
                                            <tr>
                                                <td>
                                                    <input type="hidden"
                                                        name="non_technical[{{ $aspect->id }}][aspect_id]"
                                                        value="{{ $aspect->id }}">
                                                    {{ $aspect->name }}
                                                </td>
                                                @for ($i = 1; $i <= 10; $i++)
                                                    @php
                                                        $evaluation = $nonTechnicalEvaluations->get($aspect->id);
                                                    @endphp
                                                    <td>
                                                        <input type="hidden"
                                                            name="non_technical[{{ $aspect->id }}][evaluators][{{ $i - 1 }}][evaluator_id]"
                                                            id="hidden_evaluator_id_{{ $i - 1 }}"
                                                            class="form-control" value="">
                                                        <input type="number"
                                                            name="non_technical[{{ $aspect->id }}][evaluators][{{ $i - 1 }}][score]"
                                                            class="form-control" min="40" max="90"
                                                            data-index="{{ $aspect->id }}" data-type="non_technical"
                                                            placeholder="Score"
                                                            value="{{ isset($evaluation) && isset($evaluation->evaluationDetails[$i - 1]) ? number_format(round($evaluation->evaluationDetails[$i - 1]->score), 0) : '' }}"
                                                            oninput="validateScore(this)">
                                                    </td>
                                                @endfor
                                                <td><input type="number"
                                                        name="non_technical[{{ $aspect->id }}][total_score]"
                                                        value="{{ isset($evaluation->total_score) ? number_format($evaluation->total_score, 0) : '' }}"
                                                        class="form-control" readonly>
                                                </td>
                                                <td><input type="number"
                                                        name="non_technical[{{ $aspect->id }}][total_inputted]"
                                                        value="{{ $evaluation->total_inputted ?? '' }}"
                                                        class="form-control" readonly></td>
                                                <td><input type="number"
                                                        name="non_technical[{{ $aspect->id }}][average_score]"
                                                        value="{{ $evaluation->average_score ?? '' }}"
                                                        class="form-control" readonly></td>
                                                <td><input type="number"
                                                        name="non_technical[{{ $aspect->id }}][final_score]"
                                                        value="{{ $evaluation->final_score ?? '' }}" class="form-control"
                                                        readonly></td>
                                            </tr>
                                        @endforeach
                                    @endif
                                </tbody>

                            </table>
                            <div class="card-footer">
                                <a type="button" class="btn btn-light-secondary btn-sm"
                                    href="{{ route('evaluations.index') }}">Kembali</a>
                                <button type="submit" class="btn btn-primary btn-sm">Simpan</button>
                            </div>
                        </div>


                    </div>
                </div>
            </form>
        </section>
    </div>

    {{-- Datatable --}}
    <script>
        $(document).ready(function() {
            let evaluationTable = new DataTable('#evaluationTable', {
                scrollX: true,
                fixedHeader: true,
                fixedColumns: {
                    leftColumns: 1,
                    rightColumns: 4
                },
                paging: false,
                searching: false,
                ordering: false,
                info: false,
                columnDefs: [{
                        width: '180px',
                        targets: 0
                    },
                    {
                        width: '100px',
                        targets: -4
                    },
                    {
                        width: '100px',
                        targets: -3
                    },
                    {
                        width: '100px',
                        targets: -2
                    },
                    {
                        width: '100px',
                        targets: -1
                    }
                ]
            });
        });
    </script>

    {{-- Export PDF --}}
    <script>
        $(document).on('click', '#exportPDF', function() {
            let taskId = document.getElementById('task_id').value;
            let internId = $(this).data('intern-id');
            let internName = $(this).data('intern-name');
            let taskName = $(this).data('task-name');

            Swal.fire({
                title: 'Mohon Tunggu!',
                html: 'Generate PDF..',
                allowOutsideClick: false,
                showConfirmButton: false,

                willOpen: () => {
                    Swal.showLoading();
                },
            });

            $.ajax({
                url: '{{ route('evaluations.task.score.export', ['internId' => ':internId', 'taskId' => ':taskId']) }}'
                    .replace(':internId', internId).replace(':taskId', taskId),
                type: 'GET',
                xhrFields: {
                    responseType: 'blob'
                },
                success: function(response) {
                    Swal.close();

                    const url = window.URL.createObjectURL(response);
                    const link = document.createElement('a');
                    link.href = url;
                    link.download = 'Nilai - ' + taskName + '' + ' - ' + internName + '.pdf';
                    document.body.appendChild(link);
                    link.click();
                    document.body.removeChild(link);

                },
                error: function() {
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: 'Terjadi kesalahan saat mengambil data.',
                        confirmButtonText: 'OK',
                        confirmButtonColor: "#435EBE",
                    });
                }
            });
        });
    </script>

    <script>
        $(document).ready(function() {
            initializeEvaluatorSelections();

            document.querySelectorAll('.evaluator-select').forEach(function(selectElement, index) {
                updateHiddenInputs(selectElement, index);
                selectElement.addEventListener('change', function() {
                    checkDuplicateEvaluator(index, selectElement);
                });
            });

        });

        const selectedEvaluators = {};

        function initializeEvaluatorSelections() {
            document.querySelectorAll('.evaluator-select').forEach(function(selectElement, index) {
                const selectedValue = selectElement.value;
                if (selectedValue) {
                    selectedEvaluators[index] = selectedValue;
                }
            });
        }

        function updateHiddenInputs(selectElement, evaluatorIndex) {
            const selectedEvaluatorId = selectElement.value;
            document.querySelectorAll(`input[id="hidden_evaluator_id_${evaluatorIndex}"]`).forEach(function(hiddenInput) {
                hiddenInput.value = selectedEvaluatorId;
            });
        }

        function checkDuplicateEvaluator(evaluatorIndex, selectElement) {
            const evaluatorId = selectElement.value;

            if (evaluatorId === '') {
                selectedEvaluators[evaluatorIndex] = '';
                updateHiddenInputs(selectElement, evaluatorIndex);
                return;
            }

            for (let i = 0; i < 10; i++) {
                if (i !== evaluatorIndex && selectedEvaluators[i] === evaluatorId) {
                    showWarningAndReset(evaluatorIndex, selectElement);
                    return;
                }
            }

            selectedEvaluators[evaluatorIndex] = evaluatorId;
            updateHiddenInputs(selectElement, evaluatorIndex);
        }

        function showWarningAndReset(evaluatorIndex, selectElement) {
            Swal.fire({
                icon: 'warning',
                title: 'Evaluator sudah dipilih',
                text: 'Silahkan pilih evaluator yang lain.',
                confirmButtonText: 'OK',
                confirmButtonColor: '#435EBE',
            }).then(() => {
                selectElement.value = '';
                updateHiddenInputs(selectElement, evaluatorIndex);
            });
        }
    </script>

    {{-- Scoring --}}
    <script>
        const evaluatorCount = {{ count($evaluators) }};

        function updateScores(index, type) {
            updateEvaluationScores(index, type);
        }

        function updateEvaluationScores(index, type) {
            let totalScore = 0;
            let totalInputtedScore = 0;

            for (let i = 0; i < evaluatorCount; i++) {
                const scoreInput = document.querySelector(`input[name="${type}[${index}][evaluators][${i}][score]"]`);

                if (scoreInput) {
                    const score = parseInt(scoreInput.value) || 0;
                    totalScore += score;

                    totalInputtedScore += score > 0 ? 1 : 0;
                }
            }

            const averageScore = totalInputtedScore > 0 ? (totalScore / totalInputtedScore).toFixed(2) : 0;

            document.querySelector(`input[name="${type}[${index}][total_score]"]`).value = totalScore;
            document.querySelector(`input[name="${type}[${index}][total_inputted]"]`).value = totalInputtedScore;
            document.querySelector(`input[name="${type}[${index}][average_score]"]`).value = averageScore;

            fetchTaskWeight(document.getElementById("task_id").value, index, averageScore, type);
        }

        async function fetchTaskWeight(taskId, index, averageScore, type) {
            try {
                const response = await $.ajax({
                    url: `{{ url('api/tasks') }}/${taskId}/data`,
                    method: 'GET',
                });

                const weight = response.weight;
                const finalScore = (averageScore * (weight / 100)).toFixed(2);

                document.querySelector(`input[name="${type}[${index}][final_score]"]`).value = finalScore;

            } catch (err) {
                console.error("Error fetching task weight:", err);
                alert('Error fetching task weight. Please try again later.');
            }
        }

        function validateScore(input) {
            const value = parseInt(input.value);
            const min = parseInt(input.min);
            const max = parseInt(input.max);

            input.classList.remove('is-invalid', 'is-valid');

            if (value < min || value > max) {
                input.classList.add('is-invalid');
            } else {
                input.classList.add('is-valid');
            }

            const index = input.dataset.index;
            const type = input.dataset.type;

            updateScores(index, type);
        }
    </script>

    {{-- SAVE --}}
    <script>
        $(document).ready(function() {
            $("#formEvaluation").on("submit", function(e) {

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
                    url: '{{ route('evaluations.store') }}',
                    data: new FormData(this),
                    processData: false,
                    contentType: false,
                    success: function(response) {
                        Swal.close();
                        if (response.success) {

                            Swal.fire({
                                icon: 'success',
                                title: 'Berhasil!',
                                text: 'Data berhasil disimpan.',
                                confirmButtonColor: "#435EBE",
                                cancelButtonColor: "#CDD3D8",
                            }).then(function() {
                                window.location.href =
                                    '{{ route('evaluations.index') }}';
                            });
                        } else {
                            if (response.errors) {
                                let errorMessages = '';
                                for (const key in response.errors) {
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
                            let errorMessages = '';
                            const errors = xhr.responseJSON.errors;
                            for (const key in errors) {
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

@endsection
