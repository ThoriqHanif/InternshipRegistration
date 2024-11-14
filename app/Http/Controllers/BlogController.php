<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreBlogRequest;
use App\Http\Requests\UpdateBlogRequest;
use App\Models\Blog;
use App\Models\BlogCategory;
use App\Models\Tag;
use App\Service\BlogService;
use App\Service\FileService;
use App\Service\MailService;
use App\Traits\LogActivityTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\App;

class BlogController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    use LogActivityTrait;

    private $fileService;
    private $blogService;
    private $mailService;

    public function __construct(FileService $fileService, BlogService $blogService, MailService $mailService)
    {
        $this->fileService = $fileService;
        $this->blogService = $blogService;
        $this->mailService = $mailService;
    }
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

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreBlogRequest $request)
    {
        // Shared Hosting
        // $body = str_replace('../uploads', 'https://internship.kadangkoding.com/thoriq/pendaftaran-magang/uploads', $request->input('body'));
        // $body_en = str_replace('../uploads', 'https://internship.kadangkoding.com/thoriq/pendaftaran-magang/uploads', $request->input('body_en'));

        $image_thumbnailFileName = $this->fileService->uploadFile($request->file('image_thumbnail'), 'image_thumbnail');

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
            $this->logActivity($blog, 'Menambahkan Blog', $blog->toArray());

            $this->blogService->tagSync($blog, $request['tags']);

            if ($request->status === 'published') {
                $this->mailService->sendEmailNewPost($blog);
            }

            return response()->json(['success' => true], 200);
        } else {
            return response()->json(['success' => false, 'message' => 'Failed to save blog'], 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show($locale, $slug)
    {
        App::setLocale($locale);
        $categories = BlogCategory::all();
        $tags = Tag::all();

        $blog = $this->blogService->getBlogWithAuthorBySlug($slug);
        $blog = $this->blogService->formatBlogBody($blog);
        $popularBlogs = $this->blogService->getPopularBlogs($slug);

        $socialMedias = $blog->author->isAdmin() ? [] : $this->blogService->getSocialMediaIntern($blog->author->intern->id);

        $blog = $this->blogService->formatPublishedAt($blog);
        $popularBlogs = $this->blogService->formatPopularBlogs($popularBlogs);

        $tagNames = $blog->tag->pluck('name')->toArray();

        return view('pages.users.blog.show', compact('blog', 'categories', 'tags', 'tagNames', 'popularBlogs', 'socialMedias'));
    }

    /**
     * Show the form for editing the specified resource.
     */

    public function edit($locale, $slug)
    {
        App::setLocale($locale);

        $blog = Blog::where('slug', $slug)->firstOrFail();
        $categories = BlogCategory::all();
        $tags = Tag::all();

        $blog = $this->blogService->formatBlogBody($blog);

        [$imageThumbnailUrl, $imageThumbnailExtension] = $this->fileService->getImageDetails($blog->image_thumbnail, 'image_thumbnail');

        return view('pages.users.blog.edit', compact('blog', 'categories', 'tags', 'imageThumbnailUrl', 'imageThumbnailExtension'));
    }

    /**
     * Update the specified resource in storage.
     */

    public function update(UpdateBlogRequest $request, $slug)
    {
        $blog = Blog::where('slug', $slug)->firstOrFail();
        $before = $blog->toArray();

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
                $this->fileService->deleteFile($blog->image_thumbnail, 'image_thumbnail');
            }

            $image_thumbnailFileName = $this->fileService->uploadFile($request->file('image_thumbnail'), 'image_thumbnail');
            $blog->image_thumbnail = $image_thumbnailFileName;
        }

        if ($blog->save()) {
            $after = $blog->fresh()->toArray();
            $data = [
                'before' => $before,
                'after' => $after,
            ];
            $this->logActivity($blog, 'Memperbarui Blog', $data);

            $this->blogService->tagSync($blog, $request['tags']);

            return response()->json(['success' => true]);
        } else {
            return response()->json(['success' => false]);
        }
    }


    /**
     * Publish the specified resource in storage.
     */

     public function publish($slug)
     {
         $blog = Blog::where('slug', $slug)->firstOrFail();
         $blog->status = 'published';
         $blog->published_at = now();
         $before = $blog->toArray();

         if ($blog->save()) {
            $after = $blog->fresh()->toArray();

            $data = [
                'before' => $before,
                'after' => $after,
            ];
            $this->logActivity($blog, 'Menerbitkan Blog', $data);

             $this->mailService->sendEmailNewPost($blog);
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
        $this->fileService->deleteFile($blog->image_thumbnail, 'image_thumbnail');


        if ($blog->delete()) {
            $this->logActivity($blog, 'Menghapus Blog', $blog->toArray());
            return response()->json(['success' => true]);
        } else {
            return response()->json(['success' => false]);
        }
    }

    public function uploadImage(Request $request)
    {
        $request->validate([
            'file' => 'required|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
        ]);

        $fileName = $this->fileService->uploadFile($request->file('file'), 'post');

        if ($fileName) {
            $fileUrl = asset("uploads/post/{$fileName}");

            return response()->json(['location' => $fileUrl], 200);
        }

        return response()->json(['error' => 'File upload failed.'], 400);
    }

    // protected function replaceImageUrls($body)
    // {
    //     return preg_replace_callback('/<img[^>]+src="([^"]+)"/', function ($matches) {
    //         $relativeUrl = $matches[1];
    //         return '<img src="' . url($relativeUrl) . '"';
    //     }, $body);
    // }
}
