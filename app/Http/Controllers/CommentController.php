<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCommentRequest;
use App\Models\Blog;
use App\Models\Comment;
use App\Service\MailService;
use App\Traits\LogActivityTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    use LogActivityTrait;

    private $mailService;

    public function __construct(MailService $mailService)
    {
        $this->mailService = $mailService;
    }
    public function index()
    {
        $user = auth()->user();

        if ($user->isAdmin()) {
            $blogs = Blog::with('comments.user')->get();
        } else {
            $blogs = Blog::with('comments.user')->where('author_id', $user->id)->get();
        }

        return view('pages.users.comment.index', compact('blogs'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'blog_id' => 'required',
            'user_id' => 'required',
            'name' => 'required',
            'email' => 'required|email',
            'message' => 'required',
        ]);

        $comment = new Comment();

        $comment->blog_id = $request->blog_id;
        $comment->parent_id = $request->parent_id ?? null;
        $comment->message = $request->message;

        if (Auth::check()) {
            $comment->user_id = Auth::id();
            $comment->name = Auth::user()->name;
            $comment->email = Auth::user()->email;
        } else {
            $comment->user_id = null;
            $comment->name = $request->name;
            $comment->email = $request->email;
        }

        if ($comment->save()) {

            $data = [
                'comment' => $comment->toArray()
            ];

            if ($comment->parent_id) {
                $parentComment = Comment::find($comment->parent_id);
                if ($parentComment) {
                    $data['reply'] = [
                        'id' => $comment->id,
                        'blog_id' => $comment->blog_id,
                        'user_id' => $comment->user_id,
                        'parent_id' => $comment->parent_id,
                        'name' => $comment->name,
                        'email' => $comment->email,
                        'message' => $comment->message,
                    ];

                    $data['comment'] = [
                        'id' => $parentComment->id,
                        'blog_id' => $parentComment->blog_id,
                        'user_id' => $parentComment->user_id,
                        'parent_id' => $parentComment->parent_id,
                        'name' => $parentComment->name,
                        'email' => $parentComment->email,
                        'message' => $parentComment->message,
                    ];
                }
            }

            $this->logActivity($comment, 'Balasan Komentar', $data);

            $blog = $comment->blog;
            $author = $blog->author;
            if ($author) {
                $this->mailService->sendEmailAuthorComment($comment, $blog, $author);
            }
            return response()->json(['success' => true]);
        } else {
            return response()->json(['success' => false]);
        }
    }


    /**
     * Display the specified resource.
     */
    public function show($slug)
    {
        $blog = Blog::where('slug', $slug)->firstOrFail();
        $comments = $blog->comments()->with('user')->get();

        return view('pages.users.comment.show', compact('blog', 'comments'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Comment $comment)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Comment $comment) {}

    /**
     * Remove the specified resource from storage.
     */
    // CommentController.php
    public function destroy($id)
    {
        $comment = Comment::with('replies')->findOrFail($id);

        foreach ($comment->replies as $reply) {
            $this->logActivity($reply, 'Menghapus Balasan Komentar', $reply->toArray());
            $reply->delete();
        }

        if (is_null($comment->parent_id)) {
            $this->logActivity($comment, 'Menghapus Komentar', $comment->toArray());
        } else {
            $this->logActivity($comment, 'Menghapus Balasan Komentar', $comment->toArray());
        }
        if ($comment->delete()) {

            return response()->json(['success' => true]);
        } else {
            return response()->json(['success' => false]);
        }
    }

    public function commentAndReply(StoreCommentRequest $request)
    {
        $comment = new Comment();

        $comment->blog_id = $request->blog_id;
        $comment->parent_id = $request->parent_id ?? null;
        $comment->message = $request->message;

        if (Auth::check()) {
            $comment->user_id = Auth::id();
            $comment->name = Auth::user()->name;
            $comment->email = Auth::user()->email;
        } else {
            $comment->user_id = null;
            $comment->name = $request->name;
            $comment->email = $request->email;
        }


        if ($comment->save()) {
            $this->logActivity($comment, 'Komentar Baru', $comment->toArray());
            return response()->json(['success' => true]);
        } else {
            return response()->json(['success' => false]);
        }
    }
}
