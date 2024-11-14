<?php

namespace App\Observers;

use App\Models\Intern;
use App\Traits\LogActivityTrait;

class InternObserver
{
    use LogActivityTrait;
    /**
     * Handle the Intern "created" event.
     */
    public function created(Intern $intern): void
    {
        $this->logActivity($intern, 'Menambahkan Pemagang', $intern->toArray());
    }

    /**
     * Handle the Intern "updated" event.
     */
    public function updated(Intern $intern): void
    {
        $before = $intern->getOriginal();
        $after = $intern->getChanges();

        $data = [
            'before' => $before,
            'after' => array_merge($before, $after)
        ];

        $this->logActivity($intern, 'Memperbarui Pemagang', $data);
    }

    /**
     * Handle the Intern "deleted" event.
     */
    public function deleted(Intern $intern): void
    {
        $this->logActivity($intern, 'Menghapus Pemagang', $intern->toArray());
    }

    /**
     * Handle the Intern "restored" event.
     */
    public function restored(Intern $intern): void
    {
        $this->logActivity($intern, 'Mengembalikan Pemagang', $intern->toArray());
    }

    /**
     * Handle the Intern "force deleted" event.
     */
    public function forceDeleted(Intern $intern): void
    {
        $this->logActivity($intern, 'Menghapus Permanen Pemagang', $intern->toArray());
    }
}
