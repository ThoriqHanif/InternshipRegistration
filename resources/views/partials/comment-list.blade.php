<li class="comment">
    <div class="vcard">
        <img src="{{ isset($comment->user) && $comment->user->intern ? asset('uploads/photo/' . $comment->user->intern->photo) : asset('uploads/photo/profile-maganger.jpg') }}"
            alt="Image placeholder">
    </div>
    <div class="comment-body">
        {{-- @if ($comment->parent_id)
            <div class="d-flex">
                @if ($comment->user_id == $blog->author_id)
                    <h3>{{ $comment->user->name }}
                        <span class="badge bg-primary ms-2">Author</span>
                    </h3>
                @else
                    <h3>{{ $comment->user->name ?? $comment->name }}</h3>
                @endif
                <p class="ms-3 mt-1">replied from {{ $comment->parent->name ?? 'Anonymous' }}</p>
            </div>
        @else
            @if ($comment->user_id == $blog->author_id)
                <h3>{{ $comment->user->name ?? $comment->name }}
                    <span class="badge bg-primary ms-2">Author</span>
                </h3>
            @else
                <h3>{{ $comment->user->name ?? $comment->name }}</h3>
            @endif
        @endif --}}

        <div class="d-flex">
            <h3>
                {{ $comment->user->name ?? $comment->name }}
                @if ($comment->user_id == $blog->author_id)
                    <span class="badge bg-primary ms-2">Author</span>
                @endif
            </h3>
            @if ($comment->parent_id)
                <p class="ms-3 mt-1">reply from {{ $comment->parent->name ?? 'Anonymous' }}</p>
            @endif
        </div>


        <div class="meta">{{ $comment->created_at->format('F j, Y \a\t g:i a') }}</div>
        <p class="mt-2">{{ $comment->message }}</p>
        <p>
            <a href="javascript:void(0);" class="reply rounded" data-comment-id="{{ $comment->id }}">Reply</a>
        </p>
    </div>


    <div class="reply-form" id="reply-form-{{ $comment->id }}" style="display: none; clear: both;">
        <form class="replyForm" data-parent-id="{{ $comment->id }}">
            @csrf
            <input type="hidden" name="blog_id" value="{{ $blog->id }}">
            <input type="hidden" name="parent_id" value="{{ $comment->id }}">

            @if (Auth::check())
                <div class="form-group">
                    <label for="name">Name</label>
                    <input type="text" class="form-control" name="name" value="{{ Auth::user()->name }}"
                        readonly>
                </div>
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" class="form-control" name="email" value="{{ Auth::user()->email }}"
                        readonly>
                </div>
            @else
                <div class="form-group">
                    <label for="name">Name <span class="text-danger">*</span></label>
                    <input type="text" class="form-control" name="name" required>
                </div>
                <div class="form-group">
                    <label for="email">Email <span class="text-danger">*</span></label>
                    <input type="email" class="form-control" name="email" required>
                </div>
            @endif

            <div class="form-group">
                <textarea name="message" class="form-control" rows="3" placeholder="Write a reply..."></textarea>
            </div>
            <div class="g-recaptcha mt-4 mb-4 @error('g-recaptcha-response') is-invalid @enderror"
                data-sitekey={{ config('services.recaptcha.key') }}>
                @error('g-recaptcha-response')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <button type="submit" class="btn btn-primary mt-2">Reply</button>
        </form>
    </div>

    @if ($comment->replies->isNotEmpty())
        <ul class="children">
            @foreach ($comment->replies as $reply)
                @include('partials.comment-list', ['comment' => $reply])
            @endforeach
        </ul>
    @endif
</li>
