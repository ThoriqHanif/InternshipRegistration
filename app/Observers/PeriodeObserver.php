<?php

namespace App\Observers;

use App\Models\Periode;
use App\Models\PeriodePosition;
use App\Traits\LogActivityTrait;

class PeriodeObserver
{
    /**
     * Handle the Periode "created" event.
     */
    use LogActivityTrait;

    public function created(Periode $periode): void
    {
        $positionsData = $periode->positions()->get()->toArray();

        $this->logActivity($periode, 'Menambahkan Periode', [
            'periode' => $periode->toArray(),
            'positions' => $positionsData,
        ]);
    }

    /**
     * Handle the Periode "updated" event.
     */
    public function updated(Periode $periode): void
    {
        $before = $periode->getOriginal();
        $after = $periode->getChanges();

        $changes = [
            'before' => $before,
            'after' => array_merge($before, $after)
        ];

        $this->logActivity($periode, 'Memperbarui Periode', $changes);
    }

    /**
     * Handle the Periode "deleted" event.
     */
    public function deleted(Periode $periode): void
    {
        $this->logActivity($periode, 'Menghapus Periode', $periode->toArray());
    }

    /**
     * Handle the Periode "restored" event.
     */
    public function restored(Periode $periode): void
    {
        $this->logActivity($periode, 'Mengembalikan Periode', $periode->toArray());
    }

    /**
     * Handle the Periode "force deleted" event.
     */
    public function forceDeleted(Periode $periode): void
    {
        $this->logActivity($periode, 'Menghapus Permanen Periode', $periode->toArray());
    }
}
