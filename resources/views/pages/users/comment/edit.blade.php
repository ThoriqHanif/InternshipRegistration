<div class="modal fade text-left modal-borderless" id="editComment" tabindex="-1" role="dialog"
    aria-labelledby="myModalLabel1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Balas Komentar</h5>
                <button type="button" class="close rounded-pill" data-bs-dismiss="modal" aria-label="Close">
                    <i data-feather="x"></i>
                </button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label>Nama <span class="text-danger">*</span></label>
                    <div class="input-group">
                        <input type="text" class="form-control" placeholder="" name="name" id="name"/>
                    </div>
                </div>
                <div class="form-group">
                    <label>Email <span class="text-danger">*</span></label>
                    <div class="input-group">
                        <input type="text" class="form-control" placeholder="" name="email" id="email"/>
                    </div>
                </div>
                <div class="form-group">
                    <label>Komentar <span class="text-danger">*</span></label>
                    <div class="input-group">
                        <textarea type="text" class="form-control" placeholder="" name="message" id="message"></textarea>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-light-primary" data-bs-dismiss="modal">
                    <i class="bx bx-x d-block d-sm-none"></i>
                    <span class="d-none d-sm-block">Close</span>
                </button>
                <button type="submit" class="btn btn-primary ms-1 btn-update" data-bs-dismiss="modal">
                    <i class="bx bx-check d-block d-sm-none"></i>
                    <span class="d-none d-sm-block">Update</span>
                </button>
            </div>
        </div>
    </div>
</div>
