<?php

namespace App\Http\Controllers;

use App\Mail\NewPostNotification;
use App\Models\Blog;
use App\Models\BlogCategory;
use App\Models\SocialMedia;
use App\Models\Subscription;
use App\Models\Tag;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Mail;

class BlogController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $user = Auth::user();

        if ($request->ajax()) {
            if ($user && $user->isAdmin()) {
                $blogs = Blog::with('category', 'author')->get();
            } else {
                $blogs = Blog::with('category')
                    ->where('author_id', $user->id)
                    ->get();
            }

            return DataTables::of($blogs)
                ->addColumn('action', function ($blog) {
                    return view('pages.users.blog.action', compact('blog'));
                })
                ->addIndexColumn()
                ->rawColumns(['action'])
                ->make(true);
        }

        if ($user && $user->isAdmin()) {
            return view('pages.admin.blog.index');
        }

        return view('pages.users.blog.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = BlogCategory::all();
        $tags = Tag::all();
        return view('pages.users.blog.create', compact('categories', 'tags'));
    }

    public function uploadImage(Request $request)
    {
        $request->validate([
            'file' => 'required|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
        ]);

        try {
            if ($request->hasFile('file')) {
                $file = $request->file('file');
                $fileName = Str::random(10) . '.' . $file->getClientOriginalExtension();
                $filePath = ('uploads/post/' . $fileName);

                if (!file_exists($filePath)) {
                    $file->move('uploads/post', $fileName);
                }

                $fileUrl = asset('uploads/post/' . $fileName);

                return response()->json(['location' => $fileUrl], 200);
            }

            return response()->json(['error' => 'No file uploaded.'], 400);
        } catch (\Exception $e) {
            return response()->json(['error' => 'File upload failed.'], 500);
        }
    }

    protected function notifNewPost(Blog $blog)
    {
        // Ambil semua subscriber yang aktif (status = 1)
        $subscribers = Subscription::where('status', 1)->get();

        foreach ($subscribers as $subscription) {
            Mail::to($subscription->email)->send(new NewPostNotification($blog, $subscription));
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'category_id' => 'required',
            'tags' => 'required|array',
            'title' => 'required',
            'body' => 'required',
            'image_thumbnail' => 'required|mimes:png,jpg,jpeg,webp|max:5120',
            'status' => 'required'
        ]);

        try {
            $image_thumbnailFileName = null;
            if ($request->hasFile('image_thumbnail')) {
                $image_thumbnailFile = $request->file('image_thumbnail');
                $image_thumbnailFileName = Str::random(10) . '.' . $image_thumbnailFile->getClientOriginalExtension();
                $image_thumbnailFile->move('uploads/image_thumbnail', $image_thumbnailFileName);
            }

            // Shared Hosting
            // $body = str_replace('../uploads', 'https://internship.kadangkoding.com/thoriq/pendaftaran-magang/uploads', $request->input('body'));
            // $body_en = str_replace('../uploads', 'https://internship.kadangkoding.com/thoriq/pendaftaran-magang/uploads', $request->input('body_en'));

            $author_id = Auth::id();
            $blog = new Blog();
            $blog->category_id = $request->category_id;
            $blog->author_id = $author_id;
            $blog->title = $request->title;
            $blog->title_en = $request->title_en ?? null;
            $blog->body = $request->body;
            $blog->body_en = $request->body_en ?? null;
            $blog->image_thumbnail = $image_thumbnailFileName;
            $blog->status = $request->status;

            if ($request->status === 'published') {
                $blog->published_at = now();
            }

            if ($blog->save()) {
                $tagIds = [];
                foreach ($validated['tags'] as $tag) {
                    if (is_numeric($tag)) {
                        $tagIds[] = $tag;
                    } else {
                        $newTag = Tag::firstOrCreate(['name' => $tag], ['slug' => Str::slug($tag)]);
                        $tagIds[] = $newTag->id;
                    }
                }
                $blog->tag()->sync($tagIds);

                if ($request->status === 'published') {
                    $this->notifNewPost($blog);
                }

                return response()->json(['success' => true], 200);
            } else {
                return response()->json(['success' => false, 'message' => 'Failed to save blog'], 500);
            }
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => $e->getMessage()], 500);
        }
    }

    // public function preview()
    // {
    //     return view('pages.users.blog.preview');
    // }

    /**
     * Display the specified resource.
     */
    public function show($locale, $slug)
    {
        App::setLocale($locale);
        $blog = Blog::with(['author.intern'])->where('slug', $slug)->orWhere('slug_en', $slug)->firstOrFail();
        $blog->body = $this->replaceImageUrls($blog->body);
        $blog->body_en = $this->replaceImageUrls($blog->body_en);
        $categories = BlogCategory::all();
        $tags = Tag::all();
        $blog->published_at_formatted = Carbon::parse($blog->published_at)->translatedFormat('d F Y');
        $blog->published_at_formatted_en = Carbon::parse($blog->published_at)->translatedFormat('F d, Y');

        $tagNames = $blog->tag->pluck('name')->toArray();
        $popularBlogs = Blog::where('status', 'published')
            ->where('slug', '!=', $slug)
            ->orderBy('view_count', 'desc')
            ->take(3)
            ->get();

        if ($blog->author->isAdmin()) {
            $socialMedias = [];
        } else {
            $socialMedias = $this->getSocialMediaIntern($blog->author->intern->id);
        }

        foreach ($popularBlogs as $popular) {
            $popular->published_at_formatted = Carbon::parse($popular->published_at)->translatedFormat('d F Y');
            $popular->published_at_formatted_en = Carbon::parse($popular->published_at)->translatedFormat('F d, Y');
        }


        return view('pages.users.blog.show', compact('blog', 'categories', 'tags', 'tagNames', 'popularBlogs', 'socialMedias'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    protected function getSocialMediaIntern($internId)
    {
        return SocialMedia::where('intern_id', $internId)->get();
    }

    protected function replaceImageUrls($body)
    {
        return preg_replace_callback('/<img[^>]+src="([^"]+)"/', function ($matches) {
            $relativeUrl = $matches[1];
            return '<img src="' . url($relativeUrl) . '"';
        }, $body);
    }

    public function edit($locale, $slug)
    {
        App::setLocale($locale);
        $blog = Blog::where('slug', $slug)->firstOrFail();
        $blog->body = $this->replaceImageUrls($blog->body);
        $blog->body_en = $this->replaceImageUrls($blog->body_en);
        $categories = BlogCategory::all();
        $tags = Tag::all();

        if ($blog->image_thumbnail) {
            $imageThumbnailUrl = asset('uploads/image_thumbnail/' . $blog->image_thumbnail);
            $imageThumbnailExtension = pathinfo($blog->image_thumbnail, PATHINFO_EXTENSION);
        } else {
            $imageThumbnailUrl = null;
            $imageThumbnailExtension = null;
        }

        return view('pages.users.blog.edit', compact('blog', 'categories', 'tags', 'imageThumbnailUrl', 'imageThumbnailExtension'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function publish($slug)
    {
        $blog = Blog::where('slug', $slug)->firstOrFail();
        $blog->status = 'published';
        $blog->published_at = now();

        if ($blog->save()) {
            $this->notifNewPost($blog);
            return response()->json(['success' => true]);
        } else {
            return response()->json(['success' => false]);
        }
    }

    public function update(Request $request, $slug)
    {
        $blog = Blog::where('slug', $slug)->firstOrFail();

        $validated = $request->validate([
            'category_id' => 'required',
            'tags' => 'required|array',
            'title' => 'required',
            'body' => 'required',
            'image_thumbnail' => 'nullable|mimes:png,jpg,jpeg,webp',
            'status' => 'required'
        ]);

        $blog->category_id = $request->category_id;
        $blog->title = $request->title;
        $blog->title_en = $request->title_en;
        $blog->slug = $request->slug;
        $blog->slug_en = $request->slug_en;
        $blog->body = $request->body;
        $blog->body_en = $request->body_en;
        $blog->status = $request->status;

        if ($request->status === 'published' && !$blog->published_at) {
            $blog->published_at = now();
        }

        if ($request->hasFile('image_thumbnail')) {
            if ($blog->image_thumbnail) {
                $oldImagePath = ('uploads/image_thumbnail/' . $blog->image_thumbnail);
                if (file_exists($oldImagePath)) {
                    unlink($oldImagePath);
                }
            }

            $image_thumbnailFile = $request->file('image_thumbnail');
            $image_thumbnailFileName = Str::random(10) . '.' . $image_thumbnailFile->getClientOriginalExtension();
            $image_thumbnailFile->move('uploads/image_thumbnail', $image_thumbnailFileName);
            $blog->image_thumbnail = $image_thumbnailFileName;
        }

        if ($blog->save()) {
            $tagIds = [];
            foreach ($validated['tags'] as $tag) {
                if (is_numeric($tag)) {
                    $tagIds[] = $tag;
                } else {
                    $newTag = Tag::firstOrCreate(['name' => $tag], ['slug' => Str::slug($tag)]);
                    $tagIds[] = $newTag->id;
                }
            }

            $blog->tag()->sync($tagIds);

            // if ($request->status === 'published') {
            //     $this->notifNewPost($blog);
            // }

            return response()->json(['success' => true]);
        } else {
            return response()->json(['success' => false]);
        }
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy($slug)
    {
        $blog = Blog::where('slug', $slug)->firstOrFail();
        $thumbnailPath = ('uploads/image_thumbnail/' . $blog->image_thumbnail);

        if (file_exists($thumbnailPath)) {
            unlink($thumbnailPath);
        }

        if ($blog->delete()) {
            return response()->json(['success' => true]);
        } else {
            return response()->json(['success' => false]);
        }
    }
}
