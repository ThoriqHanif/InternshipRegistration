@if ($context == 'index')
    <a href="{{ route('reports.periode.interns', $periode->id) }}"
        class="btn btn-sm bg-primary text-white btn-view-interns" data-periode-id="{{ $periode->id }}"
        data-periode-name="{{ $periode->name }}" data-toggle="tooltip" data-placement="top" title="Lihat Pemagang">
        <i class="bi bi-person mr-2"></i> Lihat Pemagang
    </a>
@endif

@if ($context == 'intern_periode')
    <a href="{{ route('reports.intern.daily', $intern->id) }}" class="btn btn-sm btn-primary">
        Daily Report
    </a>
@endif

@if ($context == 'daily_report')
    {{-- @if (in_array($report->status, [null, 'Pending', 'Rejected']))
        <a id="verifyBtn" data-report-id="{{ $report->id }}" class="btn btn-sm btn-primary me-2"
            data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Verifikasi">
            <i class="bi bi-check"></i>
        </a>
    @endif

    @if (in_array($report->status, [null, 'Pending', 'Verified']))
        <a id="rejectBtn" data-report-id="{{ $report->id }}" class="btn btn-sm btn-danger me-2"
            data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Tolak">
            <i class="bi bi-x"></i>
        </a>
    @endif --}}
@endif
