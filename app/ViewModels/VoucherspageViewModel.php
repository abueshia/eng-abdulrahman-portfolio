<?php

namespace App\ViewModels;

use Spatie\ViewModels\ViewModel;
use App\Models\Voucherspage;

class VoucherspageViewModel extends ViewModel
{
    public function __construct(public ?Voucherspage $voucherspage = null)
    {
        $this->voucherspage = is_null($voucherspage) ? new Voucherspage(old()) : $voucherspage;
    }

    public function action(): string
    {
        return is_null($this->voucherspage->id)
            ? route('admin.voucherspage.store')
            : route('admin.voucherspage.update', ['voucherspage' => $this->voucherspage->id]);
    }

    public function method(): string
    {
        return is_null($this->voucherspage->id) ? 'POST' : 'PUT';
    }
}
