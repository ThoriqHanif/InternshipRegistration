<?php

namespace App\Observers;

use App\Models\Task;
use App\Traits\LogActivityTrait;

class TaskObserver
{
    use LogActivityTrait;
    /**
     * Handle the Task "created" event.
     */
    public function created(Task $task): void
    {
        $this->logActivity($task, 'Menambahkan Tugas', $task->toArray());
    }

    /**
     * Handle the Task "updated" event.
     */
    public function updated(Task $task): void
    {
        $before = $task->getOriginal();
        $after = $task->getChanges();

        $data = [
            'before' => $before,
            'after' => array_merge($before, $after)
        ];

        $this->logActivity($task, 'Memperbarui Tugas', $data);
    }

    /**
     * Handle the Task "deleted" event.
     */
    public function deleted(Task $task): void
    {
        $this->logActivity($task, 'Menghapus Tugas', $task->toArray());
    }

    /**
     * Handle the Task "restored" event.
     */
    public function restored(Task $task): void
    {
        //
    }

    /**
     * Handle the Task "force deleted" event.
     */
    public function forceDeleted(Task $task): void
    {
        //
    }
}
