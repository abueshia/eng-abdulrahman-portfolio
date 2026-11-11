<?php

namespace App\Services;

use App\Helpers\ReorderHelper;
use App\Models\Contact;

class  ContactService
{

    public function createContact($data)
    {

        // dd($data);
        $contact = Contact::create($data);

        if (isset($data['meta_image'])) {
            $contact->storeFile($data['meta_image'], '_meta_image');
        }
    }


    public function updateContact($contact, $data)
    {
        if (isset($data['meta_image'])) {
            $contact->updateFile($data['meta_image'], '_meta_image');
        }
        $contact->update($data);
    }

    public function deleteContact($contact)
    {
        $contact->delete();
    }

    public function reorder($contact, $label, $path, $max_num)
    {
        return ReorderHelper::reorder($contact, $label, $path, $max_num);
    }

    public function saveReorder($all_entries, $contact)
    {
        return ReorderHelper::saveReorder($all_entries, $contact);
    }
}
