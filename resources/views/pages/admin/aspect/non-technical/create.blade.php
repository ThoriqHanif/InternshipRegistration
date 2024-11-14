<div class="modal fade text-left modal-borderless" id="createNonTechnicalAspect" tabindex="-1" role="dialog"
    aria-labelledby="myModalLabel1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Tambah Aspek Non Teknis</h5>
                <button type="button" class="close rounded-pill" data-bs-dismiss="modal" aria-label="Close">
                    <i data-feather="x"></i>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('non-technical-aspects.store') }}" method="post" id="formNonTechnicalAspect">
                    @csrf
                    <div class="form-group">
                        <label>Nama Aspek <span class="text-danger">*</span></label>
                        <div class="input-group">
                            <input type="text" class="form-control" placeholder="" name="name" id="name">
                        </div>
                    </div>
                    <input type="hidden" class="form-control" placeholder="" name="type" id="type" value="non-technical">

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-light-primary" data-bs-dismiss="modal">
                    <i class="bx bx-x d-block d-sm-none"></i>
                    <span class="d-none d-sm-block">Close</span>
                </button>
                <button type="submit" class="btn btn-primary ms-1" data-bs-dismiss="modal">
                    <i class="bx bx-check d-block d-sm-none"></i>
                    <span class="d-none d-sm-block">Save</span>
                </button>
            </div>
            </form>
        </div>
    </div>
</div>
</div>
