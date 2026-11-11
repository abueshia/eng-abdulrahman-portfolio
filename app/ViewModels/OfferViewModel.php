<?php

namespace App\ViewModels;

use Spatie\ViewModels\ViewModel;
use App\Models\Offer;

class OfferViewModel extends ViewModel
{
    public function __construct(public ?Offer $offer = null)
    {
        $this->offer = is_null($offer) ? new Offer(old()) : $offer;
    }

    public function action(): string
    {
        return is_null($this->offer->id)
            ? route('admin.offer.store')
            : route('admin.offer.update', ['offer' => $this->offer->id]);
    }

    public function method(): string
    {
        return is_null($this->offer->id) ? 'POST' : 'PUT';
    }
}
