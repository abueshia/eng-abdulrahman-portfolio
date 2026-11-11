<?php

namespace App\ViewModels;

use Spatie\ViewModels\ViewModel;
use App\Models\Termsandcondition;

class TermsandconditionViewModel extends ViewModel
{
    public function __construct(public ?Termsandcondition $termsandcondition = null)
    {
        $this->termsandcondition = is_null($termsandcondition) ? new Termsandcondition(old()) : $termsandcondition;
    }

    public function action(): string
    {
        return is_null($this->termsandcondition->id)
            ? route('admin.termsandcondition.store')
            : route('admin.termsandcondition.update', ['termsandcondition' => $this->termsandcondition->id]);
    }

    public function method(): string
    {
        return is_null($this->termsandcondition->id) ? 'POST' : 'PUT';
    }
}
