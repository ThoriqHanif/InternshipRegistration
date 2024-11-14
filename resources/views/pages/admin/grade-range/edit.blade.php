<div class="modal fade text-left modal-borderless" id="editGradeRange" tabindex="-1" role="dialog"
    aria-labelledby="myModalLabel1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit Skala Penilaian</h5>
                <button type="button" class="close rounded-pill" data-bs-dismiss="modal" aria-label="Close">
                    <i data-feather="x"></i>
                </button>
            </div>
            <div class="modal-body">
                <input type="hidden" class="form-control" id="grade_range_id" name="id">

                <div class="row">
                    <div class="col-6">
                        <div class="form-group">
                            <label>Nilai Minimum <span class="text-danger">*</span></label>
                            <div class="input-group">
                                <input type="number" class="form-control" placeholder="" name="min" id="min_edit">
                            </div>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-group">
                            <label>Nilai Maximum <span class="text-danger">*</span></label>
                            <div class="input-group">
                                <input type="number" class="form-control" placeholder="" name="max" id="max_edit">
                            </div>
                        </div>
                    </div>
                    <div class="col-4">
                        <div class="form-group">
                            <label>Nilai Huruf <span class="text-danger">*</span></label>
                            <div class="input-group">
                                <input type="text" class="form-control" placeholder="" name="letter_grade" id="letter_grade_edit">
                            </div>
                        </div>
                    </div>
                    <div class="col-8">
                        <div class="form-group">
                            <label>Predikat <span class="text-danger">*</span></label>
                            <div class="input-group">
                                <input type="text" class="form-control" placeholder="" name="predicate" id="predicate_edit">
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
                <button type="submit" class="btn btn-primary ms-1 btn-update" data-bs-dismiss="modal" >
                    <i class="bx bx-check d-block d-sm-none"></i>
                    <span class="d-none d-sm-block">Update</span>
                </button>
            </div>
            </form>
        </div>
    </div>
</div>
