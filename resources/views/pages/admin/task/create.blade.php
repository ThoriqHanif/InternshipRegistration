<div class="modal fade text-left modal-borderless" id="createTask" tabindex="-1" role="dialog"
    aria-labelledby="myModalLabel1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Tambah Tugas</h5>
                <button type="button" class="close rounded-pill" data-bs-dismiss="modal" aria-label="Close">
                    <i data-feather="x"></i>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('tasks.store') }}" method="post" id="formTask">
                    @csrf
                    <div class="row">
                        <div class="col-8">
                            <div class="form-group">
                                <label>Nama Tugas <span class="text-danger">*</span></label>
                                <div class="input-group mt-2">
                                    <input type="text" class="form-control" placeholder="" name="name" id="name">
                                </div>
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="form-group">
                                <label>Bobot <span class="text-danger">*</span></label>
                                <div class="input-group mt-2">
                                    <input type="number" class="form-control" placeholder="" name="weight" id="weight">
                                    <span class="input-group-text" id="basic-addon2">%</span>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 mt-2">
                            <div class="form-group">
                                <label for="" class="mb-3">Aspek Penilaian</label>
                                <ul class="list-unstyled mb-0">
                                    <li class="d-inline-block me-2 mb-1">
                                        <div class="form-check">
                                            <input type="checkbox" class="form-check-input" name="has_technical" id="has_technical_aspect" value="1">
                                            <label class="form-check-label" for="has_technical_aspects">Aspek Teknis</label>
                                        </div>
                                    </li>
                                    <li class="d-inline-block me-2 mb-1">
                                        <div class="form-check">
                                            <input type="checkbox" class="form-check-input" name="has_non_technical" id="has_non_technical_aspect" value="1">
                                            <label class="form-check-label" for="has_non_technical_aspects">Aspek Non Teknis</label>
                                        </div>
                                    </li>
                                </ul>

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
