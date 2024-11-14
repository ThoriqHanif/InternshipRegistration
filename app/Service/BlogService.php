<?php

namespace App\Service;

use App\Http\Requests\StoreBlogRequest;
use App\Mail\NewPostNotification;
use App\Models\Blog;
use App\Models\SocialMedia;
use App\Models\Subscription;
use App\Models\Tag;
use Carbon\Carbon;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;


class BlogService
{
    // Used to Store
    public function tagSync(Blog $blog, array $tags)
    {
        $tagIds = collect($tags)->map(function ($tag) {
            if (is_numeric($tag)) {
                return $tag;
            } else {
                $newTag = Tag::firstOrCreate(['name' => $tag], ['slug' => Str::slug($tag)]);
                return $newTag->id;
            }
        })->toArray();

        $blog->tag()->sync($tagIds);
    }

    public function notifyNewPost(Blog $blog)
    {
        $subscribers = Subscription::where('status', 1)->get();

        foreach ($subscribers as $subscription) {
            Mail::to($subscription->email)->send(new NewPostNotification($blog, $subscription));
        }
    }

    // Used to Show

    public function getBlogWithAuthorBySlug($slug)
    {
        return Blog::with(['author.intern'])->where('slug', $slug)->orWhere('slug_en', $slug)->firstOrFail();
    }
    public function getPopularBlogs($slug)
    {
        return Blog::where('status', 'published')
            ->where('slug', '!=', $slug)
            ->orderBy('view_count', 'desc')
            ->take(3)
            ->get();
    }

    public function formatBlogBody($blog)
    {
        $blog->body = $this->replaceImageUrls($blog->body);
        $blog->body_en = $this->replaceImageUrls($blog->body_en);

        return $blog;
    }

    public function getSocialMediaIntern($internId)
    {
        return SocialMedia::where('intern_id', $internId)->get();
    }

    public function replaceImageUrls($body)
    {
        return preg_replace_callback('/<img[^>]+src="([^"]+)"/', function ($matches) {
            $relativeUrl = $matches[1];
            return '<img src="' . url($relativeUrl) . '"';
        }, $body);
    }

    public function formatPublishedAt($blog)
    {
        $blog->published_at_formatted = Carbon::parse($blog->published_at)->translatedFormat('d F Y');
        $blog->published_at_formatted_en = Carbon::parse($blog->published_at)->translatedFormat('F d, Y');

        return $blog;
    }
    public function formatPopularBlogs($popularBlogs)
    {
        foreach ($popularBlogs as $popular) {
            $popular->published_at_formatted = Carbon::parse($popular->published_at)->translatedFormat('d F Y');
            $popular->published_at_formatted_en = Carbon::parse($popular->published_at)->translatedFormat('F d, Y');
        }

        return $popularBlogs;
    }

    // Used to Update

    public function requestData(StoreBlogRequest $request)
    {

    }
}

?>