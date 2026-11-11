<?php

namespace App\ViewModels;

use Spatie\ViewModels\ViewModel;
use App\Models\Card;

class CardViewModel extends ViewModel
{
    public function __construct(public ?Card $card = null)
    {
        $this->card = is_null($card) ? new Card(old()) : $card;
    }

    
public function action(): string
{
    return is_null($this->card->id)
        ? route('admin.card.store')
        : route('admin.card.update', ['card' => $this->card->id]);
}

public
function method(): string
{
    return is_null($this->card->id) ? 'POST' : 'PUT';
}
}
