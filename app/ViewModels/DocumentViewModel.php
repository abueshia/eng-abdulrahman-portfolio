<?php

namespace App\ViewModels;

use Spatie\ViewModels\ViewModel;
use App\Models\Document;

class DocumentViewModel extends ViewModel
{
    public function __construct(public ?Document $document = null)
    {
        $this->document = is_null($document) ? new Document(old()) : $document;
    }

    public function action(): string
    {
        return is_null($this->document->id)
            ? route('admin.document.store')
            : route('admin.document.update', ['document' => $this->document->id]);
    }

    public function method(): string
    {
        return is_null($this->document->id) ? 'POST' : 'PUT';
    }
}
