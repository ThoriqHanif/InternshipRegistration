<?php

namespace App\Observers;

use App\Models\Document;
use App\Traits\LogActivityTrait;

class DocumentObserver
{
    use LogActivityTrait;
    /**
     * Handle the Document "created" event.
     */
    public function created(Document $document): void
    {
        $this->logActivity($document, 'Menambahkan Dokumen', $document->toArray());
    }

    /**
     * Handle the Document "updated" event.
     */
    public function updated(Document $document): void
    {
        $before = $document->getOriginal();
        $after = $document->getChanges();

        $data = [
            'before' => $before,
            'after' => array_merge($before, $after)
        ];

        $this->logActivity($document, 'Memperbarui Dokumen', $data);
    }

    /**
     * Handle the Document "deleted" event.
     */
    public function deleted(Document $document): void
    {
        $this->logActivity($document, 'Menghapus Dokumen', $document->toArray());
    }

    /**
     * Handle the Document "restored" event.
     */
    public function restored(Document $document): void
    {
        //
    }

    /**
     * Handle the Document "force deleted" event.
     */
    public function forceDeleted(Document $document): void
    {
        //
    }
}
