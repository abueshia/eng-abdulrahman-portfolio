<?php

namespace App\ViewModels;

use Spatie\ViewModels\ViewModel;
use App\Models\Privacypolicy;

class PrivacypolicyViewModel extends ViewModel
{
    public function __construct(public ?Privacypolicy $privacypolicy = null)
    {
        $this->privacypolicy = is_null($privacypolicy) ? new Privacypolicy(old()) : $privacypolicy;
    }

    public function action(): string
    {
        return is_null($this->privacypolicy->id)
            ? route('admin.privacypolicy.store')
            : route('admin.privacypolicy.update', ['privacypolicy' => $this->privacypolicy->id]);
    }

    public function method(): string
    {
        return is_null($this->privacypolicy->id) ? 'POST' : 'PUT';
    }
}
