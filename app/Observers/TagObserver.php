<?php

namespace App\Observers;

use App\Models\Tag;
use App\Traits\LogActivityTrait;

class TagObserver
{
    use LogActivityTrait;
    /**
     * Handle the Tag "created" event.
     */
    public function created(Tag $tag): void
    {
        $this->logActivity($tag, 'Menambahkan Tag', $tag->toArray());
    }

    /**
     * Handle the Tag "updated" event.
     */
    public function updated(Tag $tag): void
    {
        $before = $tag->getOriginal();
        $after = $tag->getChanges();

        $data = [
            'before' => $before,
            'after' => array_merge($before, $after)
        ];

        $this->logActivity($tag, 'Memperbarui Tag', $data);
    }

    /**
     * Handle the Tag "deleted" event.
     */
    public function deleted(Tag $tag): void
    {
        $this->logActivity($tag, 'Menghapus Tag', $tag->toArray());
    }

    /**
     * Handle the Tag "restored" event.
     */
    public function restored(Tag $tag): void
    {
        //
    }

    /**
     * Handle the Tag "force deleted" event.
     */
    public function forceDeleted(Tag $tag): void
    {
        //
    }
}
