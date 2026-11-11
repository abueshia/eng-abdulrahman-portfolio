<?php

namespace App\ViewModels;

use Spatie\ViewModels\ViewModel;
use App\Models\Client;
use App\Models\Category;

class ClientViewModel extends ViewModel
{
    public function __construct(public ?Client $client = null)
    {
        $this->client = is_null($client) ? new Client(old()) : $client;
    }

    public function action(): string
    {
        return is_null($this->client->id)
            ? route('admin.client.store')
            : route('admin.client.update', ['client' => $this->client->id]);
    }

    public function method(): string
    {
        return is_null($this->client->id) ? 'POST' : 'PUT';
    }


    // public function categories()
    // {
    //     return Category::all();
    // }
    
}
