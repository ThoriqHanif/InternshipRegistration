<div class="modal fade text-left modal-borderless" id="editSocialMedia" tabindex="-1" role="dialog"
    aria-labelledby="myModalLabel1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Update Social Media</h5>
                <button type="button" class="close rounded-pill" data-bs-dismiss="modal" aria-label="Close">
                    <i data-feather="x"></i>
                </button>
            </div>
            <div class="modal-body">
                <input type="hidden" id="social_media_id" name="social_media_id">
                <div class="form-group">
                    <label>Sosial Media <span class="text-danger">*</span></label>
                    <select class="form-select mt-2 @error('name') is-invalid @enderror" id="socialMediaEdit" name="name">
                        <option value="" selected disabled>-- Platform --</option>
                        <option value="Instagram" data-url="https://instagram.com/" data-icon="bi bi-instagram" data-hint="Contoh: https://instagram.com/johndoe">
                            Instagram
                        </option>
                        <option value="Facebook" data-url="https://facebook.com/" data-icon="bi bi-facebook" data-hint="Contoh: https://facebook.com/john.doe.123">
                            Facebook
                        </option>
                        <option value="Twitter" data-url="https://twitter.com/" data-icon="bi bi-twitter" data-hint="Contoh: https://twitter.com/johndoe123">
                            Twitter
                        </option>
                        <option value="Linkedin" data-url="https://linkedin.com/in/" data-icon="bi bi-linkedin" data-hint="Contoh: https://linkedin.com/in/john-doe">
                            LinkedIn
                        </option>
                        <option value="Tiktok" data-url="https://tiktok.com/@username" data-icon="bi bi-tiktok" data-hint="Contoh: https://tiktok.com/@john_doe">
                            TikTok
                        </option>
                        <option value="Whatsapp" data-url="https://wa.me/" data-icon="bi bi-whatsapp" data-hint="Contoh: https://wa.me/6281234567890">
                            WhatsApp
                        </option>
                        <option value="Youtube" data-url="https://youtube.com/c/" data-icon="bi bi-youtube" data-hint="Contoh: https://youtube.com/c/JohnDoeChannel">
                            YouTube
                        </option>
                        <option value="other" data-manual="true">Lainnya</option>
                    </select>
                </div>
                <div class="form-group auto-field d-none">
                    <div class="form-group">
                        <label>URL <span class="text-danger">*</span></label>
                        <div class="input-group mb-1">
                            <span class="input-group-text" id="base-url-edit"></span>
                            <input type="text" class="form-control" placeholder="Username" aria-label="base-url" aria-describedby="base-url-edit" id="usernameEdit" name="username">
                        </div>
                        <p><small class="text-muted" id="hint-text-edit"></small></p>
                    </div>
                    <div class="form-group row">
                        <label>Icon</label>
                        <div class="input-group">
                            <input type="text" id="iconEdit" class="form-control" name="icon" readonly>
                            <span class="input-group-text" id="preview-icon-edit">
                                <div class="input-group-text">
                                    <i class="" style="margin-bottom: 10px"></i>
                                </div>
                            </span>
                        </div>
                    </div>
                </div>
                <div class="form-group manual-field d-none">
                    <div class="form-group">
                        <label>Nama <span class="text-danger">*</span></label>
                        <div class="input-group">
                            <input type="text" class="form-control" placeholder="e.g Github" id="manualNameEdit" name="manualName">
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Url <span class="text-danger">*</span></label>
                        <div class="input-group">
                            <input type="url" class="form-control" placeholder="https://github.com/username" id="manualUrlEdit" name="manualUrl">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label>Icon</label>
                        <div class="input-group">
                            <input type="text" id="manualIconEdit" class="form-control" name="manualIcon" placeholder="bi bi-github">
                            <span class="input-group-text" id="preview-icon-manual-edit">
                                <div class="input-group-text">
                                    <i class="" style="margin-bottom: 10px"></i>
                                </div>
                            </span>
                        </div>
                    </div>
                </div>
            </div>

            {{-- <div class="modal-body">
                <div class="form-group">
                    <input type="hidden" class="form-control" id="social_media_id" name="id">
                    <label>Nama <span class="text-danger">*</span></label>
                    <div class="input-group">
                        <input type="text" class="form-control" placeholder="e.g Instagram" name="name"
                            id="name_edit">
                    </div>
                </div>
                <div class="form-group">
                    <label>Url <span class="text-danger">*</span></label>
                    <div class="input-group">
                        <input type="url" class="form-control" placeholder="https://instagram.com/username"
                            name="url" id="url_edit">
                    </div>
                </div>
                <div class="form-group row">
                    <label>Icon <span class="text-danger"><a href="https://icons.getbootstrap.com/" target="_blank"
                                title="List Sosial Media?">?</a></span></label>

                    <div class="input-group">
                        <input type="text" id="icon_edit" class="form-control" name="icon" autofocus=""
                            value="" placeholder="bi bi-instagram">
                        <span class="input-group-text" id="basic-addon2">
                            <div class="input-group-text">
                                <i class="" id="icon_preview" style="margin-bottom: 10px"></i>
                            </div>
                        </span>
                    </div>
                </div>
            </div> --}}
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
