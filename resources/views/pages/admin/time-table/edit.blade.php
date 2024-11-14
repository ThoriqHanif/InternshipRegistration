<div class="modal fade text-left modal-borderless" id="editTimeTable" tabindex="-1" role="dialog"
    aria-labelledby="myModalLabel1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit Jam Operasional</h5>
                <button type="button" class="close rounded-pill" data-bs-dismiss="modal" aria-label="Close">
                    <i data-feather="x"></i>
                </button>
            </div>
            <div class="modal-body">
                <input type="hidden" class="form-control" id="time_table_id" name="id">

                <div class="form-group">
                    <label>Jam Mulai <span class="text-danger">*</span></label>
                    <input type="date" name="start_time"
                        class="form-control flatpickr-time-picker-24h @error('start_time') is-invalid @enderror"
                        id="start_time" placeholder="e.g. 08.00">
                </div>
                <div class="form-group">
                    <label>Jam Selesai <span class="text-danger">*</span></label>
                    <input type="date" name="end_time"
                        class="form-control flatpickr-time-picker-24h @error('end_time') is-invalid @enderror"
                        id="end_time" placeholder="e.g. 17.00">
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
            </form>
        </div>
    </div>
</div>
