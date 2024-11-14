<?php

namespace App\Providers;

use App\Models\BlogCategory;
use App\Models\Document;
use App\Models\Evaluator;
use App\Models\GradeRange;
use App\Models\Intern;
use App\Models\Periode;
use App\Models\Position;
use App\Models\SocialMedia;
use App\Models\Subscription;
use App\Models\Tag;
use App\Models\Task;
use App\Models\User;
use App\Observers\BlogCategoryObserver;
use App\Observers\DocumentObserver;
use App\Observers\EvaluatorObserver;
use App\Observers\GradeRangeObserver;
use App\Observers\InternObserver;
use App\Observers\PeriodeObserver;
use App\Observers\PositionObserver;
use App\Observers\SocialMediaObserver;
use App\Observers\SubsriptionObserver;
use App\Observers\TagObserver;
use App\Observers\TaskObserver;
use App\Observers\UserObserver;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Intern::observe(InternObserver::class);
        Position::observe(PositionObserver::class);
        // Periode::observe(PeriodeObserver::class);
        // User::observe(UserObserver::class);
        BlogCategory::observe(BlogCategoryObserver::class);
        Tag::observe(TagObserver::class);
        SocialMedia::observe(SocialMediaObserver::class);
        Document::observe(DocumentObserver::class);
        Task::observe(TaskObserver::class);
        Evaluator::observe(EvaluatorObserver::class);
        GradeRange::observe(GradeRangeObserver::class);
    }
}
