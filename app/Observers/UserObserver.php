<?php

namespace App\Observers;

use App\Models\User;
use App\Traits\LogActivityTrait;

class UserObserver
{

    use LogActivityTrait;
    /**
     * Handle the User "created" event.
     */
    public function created(User $user): void
    {
        $this->logActivity($user, 'Menambahkan User', $user->toArray());
    }

    /**
     * Handle the User "updated" event.
     */
    public function updated(User $user): void
    {
        $before = $user->getOriginal();
        $after = $user->getChanges();

        $data = [
            'before' => $before,
            'after' => array_merge($before, $after)
        ];

        $this->logActivity($user, 'Memperbarui User', $data);
    }

    /**
     * Handle the User "deleted" event.
     */
    public function deleted(User $user): void
    {
        $this->logActivity($user, 'Menghapus User', $user->toArray());
    }

    /**
     * Handle the User "restored" event.
     */
    public function restored(User $user): void
    {
        //
    }

    /**
     * Handle the User "force deleted" event.
     */
    public function forceDeleted(User $user): void
    {
        //
    }
}
