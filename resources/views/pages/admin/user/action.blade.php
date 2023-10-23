{{-- <a href="{{ route('users.download', ['id' => $users->id]) }}"
    class="btn btn-sm bg-info text-white font-weight-bold text-xs" data-toggle="tooltip" data-placement="top" title="Download Files">
    <i class="fas fa-download"></i>
</a> --}}
<a href="{{ route('users.show', $users->id) }}"
    class="btn btn-sm bg-primary text-white font-weight-bold text-xs" data-toggle="tooltip" data-placement="top" title="Detail Pemagang">
    <i class="fas fa-eye"></i>
</a>
<a href="{{ route('users.edit', $users->id) }}"
    class="btn btn-sm bg-warning text-white font-weight-bold text-xs" data-toggle="tooltip" data-placement="top" title="Edit Pemagang">
    <i class="fas fa-edit"></i>
</a>
<form style="display: inline" action="{{ route('users.destroy', $users->id) }}" method="POST">
    @csrf
    @method('DELETE')
    <button type="submit" class="btn btn-sm btn-danger delete-button" data-toggle="tooltip" data-placement="top" title="Hapus Pemagang">
        <i class="fas fa-trash"></i>
    </button>
</form>
