<div class="modal fade text-left modal-borderless" id="replyComment" tabindex="-1" role="dialog"
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
                    <div class="d-flex">
                        <label>Komentar dari</label>
                        <p id="data-comment-name" class="ms-2 text-primary"></p>
                    </div>
                    <div class="input-group mt-2">
                        <p class="meta" id="data-message"></p>
                    </div>
                </div>
                <form action="{{ route('comments.store') }}" method="post" id="formReplyComment">
                    @csrf
                    <input type="hidden" name="blog_id" id="data-blog-id">
                    <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
                    <input type="hidden" name="parent_id" id="data-parent-id">
                    <input type="hidden" name="name" value="{{ Auth::user()->name }}">
                    <input type="hidden" name="email" value="{{ Auth::user()->email }}">
                    {{-- <input type="hidden" name="parent_id" value="{{ $comment->id }}"> --}}
                    <div class="form-group">
                        <label>Balasan <span class="text-danger">*</span></label>
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
                <button type="submit" class="btn btn-primary ms-1" data-bs-dismiss="modal">
                    <i class="bx bx-check d-block d-sm-none"></i>
                    <span class="d-none d-sm-block">Save</span>
                </button>
            </div>
            </form>
        </div>
    </div>
</div>
