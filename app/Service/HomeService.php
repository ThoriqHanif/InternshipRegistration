<?php

namespace App\Service;

use App\Models\Blog;
use App\Models\BlogCategory;
use App\Models\Intern;
use App\Models\Periode;
use App\Models\Position;
use App\Models\SocialMedia;
use App\Models\Tag;
use Carbon\Carbon;

class HomeService
{
    // Landing Page
    public function countRegisterTotal()
    {
        return Intern::count();
    }

    public function countAcceptedIntern()
    {
        return Intern::where('status', 'accepted')->count();
    }

    public function countAvailablePositions(Carbon $today)
    {
        return $this->getPositionsWithinPeriod($today)->count();
    }

    public function getActivePositions(Carbon $today)
    {
        return $this->getPositionsWithinPeriod($today)->get();
    }

    private function getPositionsWithinPeriod(Carbon $today)
    {
        return Position::whereHas('periodes', function ($query) use ($today) {
            $query->where('start_date', '<=', $today)
                ->where('end_date', '>=', $today);
        });
    }

    // Landing Page -> Position
    public function checkPositionsActive($activePositions, Carbon $today)
    {
        return $activePositions->map(function ($position) use ($today) {
            $activePeriodes = $position->periodes()->where('end_date', '>=', $today)->get();
            $quotaFull = 0;
            $startDate = null;
            $comingSoon = false;

            foreach ($activePeriodes as $periode) {
                $pivotEntry = $periode->positions()->where('position_id', $position->id)->first();

                if ($pivotEntry && $pivotEntry->pivot->quota > 0) {
                    $quotaFull = $pivotEntry->pivot->quota;
                    $startDate = \Carbon\Carbon::parse($periode->start_date)->translatedFormat('j F Y');
                    $comingSoon = $today < $periode->start_date;
                    break;
                }
            }

            return [
                'position' => $position,
                'quotaFull' => $quotaFull,
                'startDate' => $startDate,
                'comingSoon' => $comingSoon
            ];
        });
    }


    // Landing Page -> Alumni

    public function getInternByPeriode()
    {
        $periodes = Periode::all();
        $internByPeriod = [];

        foreach ($periodes as $periode) {

            $internByPeriod[$periode->id] = Intern::with('social_medias')
                ->where('status', 'accepted')
                ->where('periode_id', $periode->id)
                ->orderBy('start_date', 'asc')
                ->get();
        }

        return compact('periodes', 'internByPeriod');
    }

    // Landing Page -> Blog

    public function getRecentBlog()
    {
        // return Blog::where(function ($query) use ($slug, $slug_en) {
        //     $query->where('slug', $slug)
        //         ->orWhere('slug_en', $slug_en);
        // })
        //     ->where('status', 'published')
        //     ->orderBy('created_at', 'desc')
        //     ->take(3)
        //     ->get();

        return Blog::where('status', 'published')
            ->orderBy('created_at', 'desc')
            ->take(3)
            ->get();
    }



    // Landing Page -> Main Blog
    public function getPublishedBlogs()
    {
        return Blog::where('status', 'published')->get();
    }

    public function getBlogsGroupCategory($category, $take)
    {
        return $category ? Blog::where('status', 'published')
            ->where('category_id', $category->id)
            ->orderBy('view_count', 'desc')
            ->take($take)
            ->get() : [];
    }

    public function getAllTag()
    {
        return Tag::all();
    }



    public function getPopularBlogs($excludeSlug = null)
    {
        $query = Blog::where('status', 'published')
            ->orderBy('view_count', 'desc')
            ->take(6);

        if ($excludeSlug) {
            $query->where('slug', '!=', $excludeSlug);
        }

        return $query->get();
    }



    // Landing Page -> Detail Blog
    public function getCategoryWithSlug($slug)
    {
        return BlogCategory::where('slug', $slug)->firstOrFail();
    }

    public function getCategoriesWithBlogCount()
    {
        return BlogCategory::withCount('blog')->get();
    }

    public function countCategoriesWithBlog()
    {
        return BlogCategory::withCount('blog')
            ->withSum('blog', 'view_count')
            ->orderBy('blog_sum_view_count', 'desc')
            ->take(4)
            ->get();
    }

    public function getPopularBlogsDetail()
    {
        return Blog::where('status', 'published')
            // ->where('slug', '!=', $slug)
            ->orderBy('view_count', 'desc')
            ->take(3)
            ->get();
    }
    public function getRelatedBlogsByTag($tagId, $slug)
    {
        return Blog::whereHas('tag', function ($query) use ($tagId) {
            $query->where('id', $tagId);
        })->where('slug', '!=', $slug)->get();
    }
    public function incrementViewCount($blog)
    {
        $blog->increment('view_count');
        return $this->formatBlogDate($blog);
    }
    public function replaceImageUrls($body)
    {
        return preg_replace_callback('/<img[^>]+src="([^"]+)"/', function ($matches) {
            return '<img src="' . url($matches[1]) . '"';
        }, $body);
    }

    public function getSocialMediaIntern($internId)
    {
        return SocialMedia::where('intern_id', $internId)->get();
    }

    // Landing Page -> Blog -> Detail by Category
    public function getBlogsByCategory($categoryId, $pagination = 5)
    {
        return Blog::where('category_id', $categoryId)
            ->where('status', 'published')
            ->orderBy('published_at', 'desc')
            ->paginate($pagination);
    }

    // Landing Page -> Blog -> Detail by Tag
    public function getTagBySlug($slug)
    {
        return Tag::where('slug', $slug)->firstOrFail();
    }
    public function getBlogsByTag($tagId, $pagination = 5)
    {
        return Blog::whereHas('tag', function ($query) use ($tagId) {
            $query->where('id', $tagId);
        })->where('status', 'published')
            ->orderBy('published_at', 'desc')
            ->paginate($pagination);
    }

    // Format Date
    public function formatBlogs($blogs)
    {
        return $blogs->map(function ($blog) {
            return $this->formatBlogDate($blog);
        });
    }

    public function formatBlogDates($blogs)
    {
        foreach ($blogs as $blog) {
            $this->formatBlogDate($blog);
        }
    }

    public function formatBlogDate($blog)
    {
        $blog->published_at_formatted = Carbon::parse($blog->published_at)->translatedFormat('d F Y'); // Format Bahasa Indonesia
        $blog->published_at_formatted_en = Carbon::parse($blog->published_at)->translatedFormat('F d, Y'); // Format Bahasa Inggris (disamakan)
        return $blog;
    }
}
