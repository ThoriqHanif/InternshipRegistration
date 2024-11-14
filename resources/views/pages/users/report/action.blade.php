@if ($report->status == 'Verified')
    <a type="button" id="detailReportBtn" data-report-id="{{ $report->id }}" title="Detail Report"><span
            class="badge bg-primary">Terverifikasi <i class="bi bi-info-circle-fill ms-2"></i></span></a>
@elseif ($report->status == 'Rejected')
    <a type="button" id="detailReportBtn" data-report-id="{{ $report->id }}" title="Detail Report"><span
            class="badge bg-danger">Ditolak <i class="bi bi-info-circle-fill ms-2"></i></span></a>
@else
    @if ($report->presence !== null)
        <a type="button" id="detailReportBtn" data-report-id="{{ $report->id }}" title="Detail Report">
            <span class="badge bg-primary">Detail <i class="bi bi-info-circle-fill ms-2"></i></span>
        </a>
    @endif
    <button type="button" class="btn btn-sm bg-warning text-white font-weight-bold text-xs tombol-edit"
        data-toggle="tooltip" data-placement="top" id="btn-edit" title="Edit Report"
        data-report-id="{{ $report->id }}" data-report-date="{{ $report->date }}">
        <i class="bi bi-pencil-square"></i>
    </button>
@endif
