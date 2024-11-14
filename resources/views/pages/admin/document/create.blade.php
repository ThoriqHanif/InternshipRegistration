<div class="modal fade text-left modal-borderless" id="createDocument" tabindex="-1" role="dialog"
    aria-labelledby="myModalLabel1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Tambah Dokumen</h5>
                <button type="button" class="close rounded-pill" data-bs-dismiss="modal" aria-label="Close">
                    <i data-feather="x"></i>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('documents.store') }}" method="post" id="formDocument">
                    @csrf
                    <div class="form-group">
                        <label>Pemagang <span class="text-danger">*</span></label>
                        <select
                        class="form-select mt-2  @error('intern') is-invalid @enderror"
                        name="intern_id" id="intern">
                            <option value="" selected disabled>-- Pemagang --</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Tipe Dokumen <span class="text-danger">*</span></label>
                        <select name="type" id="type" class="form-select">
                            <option value="" selected>-- Tipe Dokumen --</option>
                            <option value="report">Laporan</option>
                            <option value="assesment">Penilaian</option>
                            <option value="announcement">Pengumuman</option>
                            <option value="certificate">Sertifikat</option>
                            <option value="evaluation">Evaluasi</option>
                            <option value="etc">Lainnya</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Nama Dokumen <span class="text-danger">*</span></label>
                        <div class="input-group mt-2">
                            <input type="text" class="form-control" placeholder="" name="name" id="name">
                        </div>
                    </div>
                    <div class="form-group">
                        <label>File <span class="text-danger">*</span></label>
                        <div class="custom-file mt-2">
                            <input
                                class="form-control @error('file') is-invalid @enderror"
                                type="file" id="file" name="file"
                                accept=".pdf, .docx, .png">
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Catatan</label>
                        <div class="input-group mt-2">
                            <textarea type="text" class="form-control" placeholder="" name="note" id="note"></textarea>
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
