<?php

namespace App\ViewModels;

use Spatie\ViewModels\ViewModel;
use App\Models\Contact;

class ContactViewModel extends ViewModel
{
    public function __construct(public ?Contact $contact = null)
    {
        $this->contact = is_null($contact) ? new Contact(old()) : $contact;
    }

    public function action(): string
    {
        return is_null($this->contact->id)
            ? route('admin.contact.store')
            : route('admin.contact.update', ['contact' => $this->contact->id]);
    }

    public function method(): string
    {
        return is_null($this->contact->id) ? 'POST' : 'PUT';
    }
}
