<?php

namespace App\ViewModels;

use Spatie\ViewModels\ViewModel;
use App\Models\Notification;

class NotificationViewModel extends ViewModel
{
    public function __construct(public ?Notification $notification = null)
    {
        $this->notification = is_null($notification) ? new Notification(old()) : $notification;
    }

    public function action(): string
    {
        return is_null($this->notification->id)
            ? route('admin.notification.store')
            : route('admin.notification.update', ['notification' => $this->notification->id]);
    }

    public function method(): string
    {
        return is_null($this->notification->id) ? 'POST' : 'PUT';
    }
}
