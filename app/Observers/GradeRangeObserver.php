<?php

namespace App\Observers;

use App\Models\GradeRange;
use App\Traits\LogActivityTrait;

class GradeRangeObserver
{
    use LogActivityTrait;
    /**
     * Handle the GradeRange "created" event.
     */
    public function created(GradeRange $gradeRange): void
    {
        $this->logActivity($gradeRange, 'Menambahkan Skala Penilaian', $gradeRange->toArray());
    }

    /**
     * Handle the GradeRange "updated" event.
     */
    public function updated(GradeRange $gradeRange): void
    {
        $before = $gradeRange->getOriginal();
        $after = $gradeRange->getChanges();

        $data = [
            'before' => $before,
            'after' => array_merge($before, $after)
        ];

        $this->logActivity($gradeRange, 'Memperbarui Skala Penilaian', $data);
    }

    /**
     * Handle the GradeRange "deleted" event.
     */
    public function deleted(GradeRange $gradeRange): void
    {
        $this->logActivity($gradeRange, 'Menghapus Skala Penilaian', $gradeRange->toArray());
    }

    /**
     * Handle the GradeRange "restored" event.
     */
    public function restored(GradeRange $gradeRange): void
    {
        //
    }

    /**
     * Handle the GradeRange "force deleted" event.
     */
    public function forceDeleted(GradeRange $gradeRange): void
    {
        //
    }
}
