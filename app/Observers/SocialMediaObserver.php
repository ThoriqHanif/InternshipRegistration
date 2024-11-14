<?php

namespace App\Observers;

use App\Models\SocialMedia;
use App\Traits\LogActivityTrait;

class SocialMediaObserver
{
    use LogActivityTrait;
    /**
     * Handle the SocialMedia "created" event.
     */
    public function created(SocialMedia $socialMedia): void
    {
        $this->logActivity($socialMedia, 'Menambahkan Social Media', $socialMedia->toArray());
    }

    /**
     * Handle the SocialMedia "updated" event.
     */
    public function updated(SocialMedia $socialMedia): void
    {
        $before = $socialMedia->getOriginal();
        $after = $socialMedia->getChanges();

        $data = [
            'before' => $before,
            'after' => array_merge($before, $after)
        ];

        $this->logActivity($socialMedia, 'Memperbarui Social Media', $data);
    }

    /**
     * Handle the SocialMedia "deleted" event.
     */
    public function deleted(SocialMedia $socialMedia): void
    {
        //
        $this->logActivity($socialMedia, 'Menghapus Social Media', $socialMedia->toArray());
    }

    /**
     * Handle the SocialMedia "restored" event.
     */
    public function restored(SocialMedia $socialMedia): void
    {
        //
    }

    /**
     * Handle the SocialMedia "force deleted" event.
     */
    public function forceDeleted(SocialMedia $socialMedia): void
    {
        //
    }
}
