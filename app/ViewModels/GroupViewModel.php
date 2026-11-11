<?php

namespace App\ViewModels;

use Spatie\ViewModels\ViewModel;
use App\Models\Group;

class GroupViewModel extends ViewModel
{
    public function __construct(public ?Group $group = null)
    {
        $this->group = is_null($group) ? new Group(old()) : $group;
    }

    public function action(): string
    {
        return is_null($this->group->id)
            ? route('admin.group.store')
            : route('admin.group.update', ['group' => $this->group->id]);
    }

    public function method(): string
    {
        return is_null($this->group->id) ? 'POST' : 'PUT';
    }
}
