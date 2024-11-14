<?php

namespace App\Observers;

use App\Models\LogActivity;
use App\Models\Position;
use App\Traits\LogActivityTrait;
use Illuminate\Support\Facades\Auth;

class PositionObserver
{
    /**
     * Handle the Position "created" event.
     */
    use LogActivityTrait;
    public function created(Position $position): void
    {
        $this->logActivity($position, 'Menambahkan Posisi ', $position->toArray());
    }

    /**
     * Handle the Position "updated" event.
     */
    public function updated(Position $position): void
    {
        $before = $position->getOriginal();
        $after = $position->getChanges();

        $data = [
            'before' => $before,
            'after' => array_merge($before, $after)
        ];

        $this->logActivity($position, 'Memperbarui Posisi', $data);
    }

    /**
     * Handle the Position "deleted" event.
     */
    public function deleted(Position $position): void
    {
        $this->logActivity($position, 'Menghapus Posisi', $position->toArray());
    }

    /**
     * Handle the Position "restored" event.
     */
    public function restored(Position $position): void
    {
        $this->logActivity($position, 'Mengembalikan Posisi', $position->toArray());
    }

    /**
     * Handle the Position "force deleted" event.
     */
    public function forceDeleted(Position $position): void
    {
        $this->logActivity($position, 'Menghapus Permanen Posisi', $position->toArray());

    }
}
