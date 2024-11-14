<div class="modal fade text-left modal-borderless" id="createGradeRange" tabindex="-1" role="dialog"
    aria-labelledby="myModalLabel1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Tambah Skala Penilaian</h5>
                <button type="button" class="close rounded-pill" data-bs-dismiss="modal" aria-label="Close">
                    <i data-feather="x"></i>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('grade-ranges.store') }}" method="post" id="formGradeRange">
                    @csrf
                    <div class="row">
                        <div class="col-4">
                            <div class="form-group">
                                <label>Nilai Minimum <span class="text-danger">*</span></label>
                                <div class="input-group">
                                    <input type="number" class="form-control" placeholder="" name="min" id="min">
                                </div>
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="form-group">
                                <label>Nilai Maximum <span class="text-danger">*</span></label>
                                <div class="input-group">
                                    <input type="number" class="form-control" placeholder="" name="max" id="max">
                                </div>
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="form-group">
                                <label>Nilai Huruf <span class="text-danger">*</span></label>
                                <div class="input-group">
                                    <input type="text" class="form-control" placeholder="" name="letter_grade" id="letter_grade">
                                </div>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-group">
                                <label>Predikat <span class="text-danger">*</span></label>
                                <div class="input-group">
                                    <input type="text" class="form-control" placeholder="" name="predicate" id="predicate">
                                </div>
                            </div>
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
