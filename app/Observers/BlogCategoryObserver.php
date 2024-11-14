<?php

namespace App\Observers;

use App\Models\BlogCategory;
use App\Models\LogActivity;
use App\Traits\LogActivityTrait;
use Illuminate\Support\Facades\Auth;

class BlogCategoryObserver
{
    /**
     * Handle the BlogCategory "created" event.
     */
    use LogActivityTrait;
    public function created(BlogCategory $blogCategory): void
    {
        $this->logActivity($blogCategory, 'Menambahkan Kategori Blog', $blogCategory->toArray());

    }

    /**
     * Handle the BlogCategory "updated" event.
     */
    public function updated(BlogCategory $blogCategory): void
    {
        $before = $blogCategory->getOriginal();
        $after = $blogCategory->getChanges();

        $data = [
            'before' => $before,
            'after' => array_merge($before, $after)
        ];

        $this->logActivity($blogCategory, 'Memperbarui Kategori Blog', $data);
    }

    /**
     * Handle the BlogCategory "deleted" event.
     */
    public function deleted(BlogCategory $blogCategory): void
    {
        $this->logActivity($blogCategory, 'Menghapus Kategori Blog', $blogCategory->toArray());
    }

    /**
     * Handle the BlogCategory "restored" event.
     */
    public function restored(BlogCategory $blogCategory): void
    {
        //
    }

    /**
     * Handle the BlogCategory "force deleted" event.
     */
    public function forceDeleted(BlogCategory $blogCategory): void
    {
        //
    }


}
