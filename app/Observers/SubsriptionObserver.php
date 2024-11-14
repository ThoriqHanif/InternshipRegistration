<?php

namespace App\Observers;

use App\Models\Subscription;
use App\Traits\LogActivityTrait;

class SubsriptionObserver
{
    use LogActivityTrait;
    /**
     * Handle the Subscription "created" event.
     */
    public function created(Subscription $subscription): void
    {
        $this->logActivity($subscription, 'Menambahkan Pelanggan', $subscription->toArray());
    }

    /**
     * Handle the Subscription "updated" event.
     */
    public function updated(Subscription $subscription): void
    {
        $before = $subscription->getOriginal();
        $after = $subscription->getChanges();

        $data = [
            'before' => $before,
            'after' => array_merge($before, $after)
        ];

        $this->logActivity($subscription, 'Memperbarui Pelanggan', $data);
    }

    /**
     * Handle the Subscription "deleted" event.
     */
    public function deleted(Subscription $subscription): void
    {
        $this->logActivity($subscription, 'Menghapus Pelanggan', $subscription->toArray());
    }

    /**
     * Handle the Subscription "restored" event.
     */
    public function restored(Subscription $subscription): void
    {
        //
    }

    /**
     * Handle the Subscription "force deleted" event.
     */
    public function forceDeleted(Subscription $subscription): void
    {
        //
    }
}
