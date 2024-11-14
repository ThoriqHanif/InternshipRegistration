@if ($context == 'intern')
    <a href="{{ route('evaluations.show', $intern->id) }}" class="btn btn-sm bg-primary text-white font-weight-bold text-xs detail-aspect" data-toggle="tooltip"
        data-placement="top" title="Detail Aspek Teknis" data-intern-id={{ $intern->id }}><i class="bi bi-eye me-2"></i>
        Detail
    </a>
@endif
