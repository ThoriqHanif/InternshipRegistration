<div class="modal fade" id="modalDetailReport" aria-hidden="true"
    aria-labelledby="exampleModalToggleLabel2" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <input type="hidden" class="form-control" id="report_id" name="report_id">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="reportModalLabel">Detail Laporan Harian
                </h5>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body p-4">
                <div class="row">
                    <div class="col-md-12">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <input type="hidden" class="form-control" id="report_id__detail" name="report_id">
                                    <label for="">Tanggal</label>
                                    <p id="date_detail"></p>
                                </div>
                                <div class="form-group">
                                    <label for="">Presensi</label>
                                    <p id="presence_detail"></p>
                                </div>
                                <div class="form-group">
                                    <label for="">Jam Kehadiran</label>
                                    <p id="attendance_time_detail"></p>
                                </div>
                            </div>
                            <div class="col-md-8">
                                <div class="form-group">
                                    <label for="">Agensi</label>
                                    <p id="agency_detail"></p>
                                </div>
                                <div class="form-group">
                                    <label for="">Nama Project</label>
                                    <p id="project_name_detail"></p>
                                </div>
                                <div class="form-group">
                                    <label for="">Pekerjaan</label>
                                    <p id="job_detail"></p>
                                </div>
                                <div class="form-group">
                                    <label for="">Deskripsi Pekerjaan</label>
                                    <p id="description_detail"></p>
                                </div>
                            </div>
                            <hr class="">
                        </div>
                    </div>

                    <div class="col-md-6 d-none mt-2" id="lateness">
                        <div class="form-group">
                            <label for="">Informasi Keterlambatan </label>
                        </div>
                        <p>Terlambat <strong class="text-danger" id="lateness-duration_detail"></strong>
                            dari
                            jam kehadiran</p>
                        <div class="form-group">
                            <label for="">Total keterlambatan</label>
                            <div class="d-flex">
                                <p id="total-lateness-info_detail">
                                <p>x pada <span class="text-primary" id="lateness-dates_detail"></span></p>
                                </p>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="is_consequence_done" class="mb-2">Sudah melaksanakan
                                konsekuensi?</label>
                            <ul class="list-unstyled mb-0">
                                <li class="d-inline-block me-2 mb-1">
                                    <div class="form-check">
                                        <div class="custom-control custom-checkbox">
                                            <input type="checkbox"
                                                class="form-check-input form-check-success form-check-glow"
                                                name="is_consequence_done" id="is_consequence_done_detail" disabled>
                                            <label class="form-check-label" for="done">Sudah</label>
                                        </div>
                                    </div>
                                </li>
                            </ul>
                        </div>
                        <div class="form-group">
                            <label for="description">Keterangan</label>
                            <p  id="consequence_description_detail"
                                 name="consequence_description" ></p>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="">Informasi Status Laporan </label>
                        </div>
                        {{-- <div class="form-group">
                            <label for="">Status</label>
                            <p><span id="status_report_detail" class="badge bg-primary"></span></p>
                        </div> --}}
                        <div class="form-group">
                            <label for="">Status</label>
                            <p><span id="is_late_detail" class="badge bg-primary"></span></p>
                        </div>
                        <div class="form-group">
                            <label for="">Dibuat pada</label>
                            <p id="created_at_detail"></p>
                        </div>
                        <div class="form-group">
                            <label for="">Terakhir diubah pada</label>
                            <p id="updated_at_detail"></p>
                        </div>
                        {{-- <div class="form-group">
                            <label for="">Alasan Admin</label>
                            <p id="admin_reason_detail"></p>
                        </div> --}}
                    </div>
                </div>

            </div>
            <div class="modal-footer">
                <button class="btn btn-secondary" data-bs-dismiss="modal" id="backBtn">Tutup</button>
            </div>
        </div>
    </div>
</div>
