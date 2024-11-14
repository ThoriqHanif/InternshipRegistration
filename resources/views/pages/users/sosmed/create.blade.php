<div class="modal fade text-left modal-borderless" id="createSocialMedia" tabindex="-1" role="dialog"
    aria-labelledby="myModalLabel1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Tambah Social Media</h5>
                <button type="button" class="close rounded-pill" data-bs-dismiss="modal" aria-label="Close">
                    <i data-feather="x"></i>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('social-medias.store') }}" method="post" id="formSocialMedia">
                    @csrf
                    <div class="form-group">
                        <label>Nama <span class="text-danger">*</span></label>
                        <div class="input-group">
                            <input type="text" class="form-control" placeholder="e.g Instagram" name="name"
                                id="name">
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Url <span class="text-danger">*</span></label>
                        <div class="input-group">
                            <input type="url" class="form-control" placeholder="https://instagram.com/username"
                                name="url" id="url">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label>Icon <span class="text-danger"><a href="https://icons.getbootstrap.com/" target="_blank" title="List Sosial Media?">?</a></span></label>

                        <div class="input-group">
                            <input type="text" id="icon" class="form-control" name="icon" autofocus=""
                                value="" placeholder="bi bi-instagram">
                            <span class="input-group-text" id="basic-addon2">
                                <div class="input-group-text">
                                    <i class="" style="margin-bottom: 10px"></i>
                                </div>
                            </span>
                        </div>
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
