<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Models\BlogCategory;
use App\Models\Intern;
use App\Models\Position;
use App\Models\SocialMedia;
use App\Models\Tag;
use App\Service\CommentService;
use App\Service\HomeService;
use Carbon\Carbon;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\DB;


class HomeController extends Controller
{
    protected $homeService;
    protected $commentService;
    public function __construct(HomeService $homeService, CommentService $commentService)
    {
        $this->homeService = $homeService;
        $this->commentService = $commentService;
    }
    public function index($locale)
    {
        App::setLocale($locale);
        $today = Carbon::now();
        $registerTotal = $this->homeService->countRegisterTotal();
        $acceptedIntern = $this->homeService->countAcceptedIntern();
        $availablePositions = $this->homeService->countAvailablePositions($today);
        $activePositions = $this->homeService->getActivePositions($today);
        $checkActivePositions = $this->homeService->checkPositionsActive($activePositions, $today);

        // intern
        $data = $this->homeService->getInternByPeriode();
        $periodes = $data['periodes'];
        $internByPeriod = $data['internByPeriod'];

        // Recent Blog
        $recentBlogs = $this->homeService->getRecentBlog();
        $formattedBlogs = $this->homeService->formatBlogs($recentBlogs);
        $this->homeService->formatBlogDates($recentBlogs);


        return view('pages.home.index', compact('registerTotal', 'acceptedIntern', 'availablePositions', 'activePositions', 'today', 'checkActivePositions', 'periodes', 'internByPeriod', 'recentBlogs'));
    }

    public function blog($locale)
    {
        App::setLocale($locale);

        $blogs = $this->homeService->getPublishedBlogs();
        $tags = $this->homeService->getAllTag();
        $categories = $this->homeService->countCategoriesWithBlog();
        $popularBlogs = $this->homeService->getPopularBlogs();
        $formattedBlogs = $this->homeService->formatBlogs($blogs);

        $categoryBlogs = [];
        foreach ($categories as $key => $category) {
            $categoryBlogs[$key] = $this->homeService->getBlogsGroupCategory($category, $key + 2);
        }

        $formattedBlogs = $this->homeService->formatBlogs($blogs);
        $this->homeService->formatBlogDates($popularBlogs);


        return view('pages.home.blog.index', compact(
            'tags',
            'popularBlogs',
            'formattedBlogs',
            'categories',
            'categoryBlogs',
        ));
    }

    public function detail($locale, $slug)
    {
        App::setLocale($locale);

        $categories = BlogCategory::withCount('blog')->get();
        $blog = Blog::where('slug', $slug)->orWhere('slug_en', $slug)->firstOrFail();

        $tags = $this->homeService->getAllTag();
        $popularBlogs = $this->homeService->getPopularBlogsDetail();
        $relatedBlogs = $this->homeService->getRelatedBlogsByTag($blog->tag->pluck('id')->toArray(), $slug);
        $socialMedias = $blog->author->isAdmin() ? [] : $this->homeService->getSocialMediaIntern($blog->author->intern->id);

        $blog->body = $this->homeService->replaceImageUrls($blog->body);
        $blog->body_en = $this->homeService->replaceImageUrls($blog->body_en);

        $tagIds = $blog->tag ? $blog->tag->pluck('id')->toArray() : [];
        $tagNames = $blog->tag->pluck('name')->toArray();
        $this->homeService->incrementViewCount($blog);

        // Comments
        $comments = $this->commentService->getAllComments($blog->id);

        foreach ($popularBlogs as $popular) {
            $this->homeService->formatBlogDate($popular);
        }

        return view('pages.home.blog.detail', compact(
            'blog', 'popularBlogs', 'categories', 'tags', 'tagNames', 'relatedBlogs', 'socialMedias', 'comments'
        ));
    }

    public function detailCategory($locale, $slug)
    {
        App::setLocale($locale);

        $category = $this->homeService->getCategoryWithSlug($slug);
        $categories = $this->homeService->countCategoriesWithBlog();
        $tags = $this->homeService->getAllTag();
        $blogsByCategory = $this->homeService->getBlogsByCategory($category->id);
        $popularBlogs = $this->homeService->getPopularBlogsDetail($slug);

        $this->homeService->formatBlogDates($blogsByCategory);
        $this->homeService->formatBlogDates($popularBlogs);

        return view('pages.home.blog.category-detail', compact('category', 'blogsByCategory', 'categories', 'tags', 'popularBlogs'));
    }

    public function detailTag($locale, $slug)
    {
        App::setLocale($locale);

        $tag = $this->homeService->getTagBySlug($slug);
        $tags = $this->homeService->getAllTag();
        $blogsByTag = $this->homeService->getBlogsByTag($tag->id);
        $categories = $this->homeService->countCategoriesWithBlog();
        $popularBlogs = $this->homeService->getPopularBlogsDetail($slug);

        $this->homeService->formatBlogDates($blogsByTag);
        $this->homeService->formatBlogDates($popularBlogs);

        return view('pages.home.blog.tag-detail', compact('blogsByTag', 'tag', 'tags', 'categories', 'popularBlogs'));
    }
}
