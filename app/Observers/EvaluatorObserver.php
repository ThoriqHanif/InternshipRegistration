<?php

namespace App\Observers;

use App\Models\Evaluator;
use App\Traits\LogActivityTrait;

class EvaluatorObserver
{
    use LogActivityTrait;
    /**
     * Handle the Evaluator "created" event.
     */
    public function created(Evaluator $evaluator): void
    {
        $this->logActivity($evaluator, 'Menambahkan Penilai', $evaluator->toArray());
    }

    /**
     * Handle the Evaluator "updated" event.
     */
    public function updated(Evaluator $evaluator): void
    {
        $before = $evaluator->getOriginal();
        $after = $evaluator->getChanges();

        $data = [
            'before' => $before,
            'after' => array_merge($before, $after)
        ];

        $this->logActivity($evaluator, 'Memperbarui Penilai', $data);
    }

    /**
     * Handle the Evaluator "deleted" event.
     */
    public function deleted(Evaluator $evaluator): void
    {
        $this->logActivity($evaluator, 'Menghapus Penilai', $evaluator->toArray());
    }

    /**
     * Handle the Evaluator "restored" event.
     */
    public function restored(Evaluator $evaluator): void
    {
        //
    }

    /**
     * Handle the Evaluator "force deleted" event.
     */
    public function forceDeleted(Evaluator $evaluator): void
    {
        //
    }
}
