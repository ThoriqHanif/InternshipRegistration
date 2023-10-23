<a href="{{ route('position.show', $positions->id) }}"
    class="btn btn-sm bg-primary text-white font-weight-bold text-xs" data-toggle="tooltip" data-placement="top" title="Detail Pemagang">
    <i class="fas fa-eye"></i>
</a>
<a href="{{ route('position.edit', $positions->id) }}"
    class="btn btn-sm bg-warning text-white font-weight-bold text-xs" data-toggle="tooltip" data-placement="top" title="Edit Pemagang">
    <i class="fas fa-edit"></i>
</a>
<form style="display: inline" action="{{ route('position.destroy', $positions->id) }}" method="POST">
    @csrf
    @method('DELETE')
    <button type="submit" class="btn btn-sm btn-danger delete-button" data-toggle="tooltip" data-placement="top" title="Hapus Pemagang">
        <i class="fas fa-trash"></i>
    </button>
</form>