<?php

namespace App\ViewModels;

use Spatie\ViewModels\ViewModel;
use App\Models\Complaint;

class ComplaintViewModel extends ViewModel
{
    public function __construct(public ?Complaint $complaint = null)
    {
        $this->complaint = is_null($complaint) ? new Complaint(old()) : $complaint;
    }

    public function action(): string
    {
        return is_null($this->complaint->id)
            ? route('admin.complaint.store')
            : route('admin.complaint.update', ['complaint' => $this->complaint->id]);
    }

    public function method(): string
    {
        return is_null($this->complaint->id) ? 'POST' : 'PUT';
    }
}
