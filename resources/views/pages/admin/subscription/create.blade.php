<div class="modal fade text-left modal-borderless" id="createSubscriptions" tabindex="-1" role="dialog"
    aria-labelledby="myModalLabel1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Tambah Pelanggan</h5>
                <button type="button" class="close rounded-pill" data-bs-dismiss="modal" aria-label="Close">
                    <i data-feather="x"></i>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('subscriptions.store') }}" method="post" id="formSubscriptions">
                    @csrf
                    <div class="form-group">
                        <label>Email <span class="text-danger">*</span></label>
                        <div class="input-group">
                            <input type="email" class="form-control" placeholder="" name="email" id="email">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="">Status <span class="text-danger">*</span></label>
                        <select class="form-select form-control" name="status" id="">
                            <option value="" selected>Pilih Status</option>
                            <option value="1">Aktif</option>
                            <option value="0">Nonaktif</option>
                        </select>
                    </div>
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
