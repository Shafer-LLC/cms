<?php

namespace Dply\CMS\Support\Notifications;

use Illuminate\Support\Arr;
use Dply\Backend\Models\EmailList;
use Dply\CMS\Models\User;
use Dply\CMS\Support\Email;

class EmailNotification extends NotificationAbstract
{
    public function handle()
    {
        $query = User::query();
        $userIds = $this->users[0] != -1 ? $this->users : null;
        if ($userIds) {
            $query->whereIn('id', $userIds);
        }

        $users = $query->get();

        foreach ($users as $user) {
            $subject = Arr::get($this->notification->data, 'subject');
            $body = Arr::get($this->notification->data, 'body');
            $userParams = [
                'name' => $user->name,
                'email' => $user->email,
            ];

            $subject = EmailList::mapParams(
                $subject,
                $userParams
            );

            $body = EmailList::mapParams(
                $body,
                $userParams
            );

            (Email::make())
                ->withTemplate('notification')
                ->setEmails($user->email)
                ->setParams(
                    [
                        'subject' => $subject,
                        'body' => $body,
                        'url' => Arr::get($this->notification->data, 'url'),
                        'image' => Arr::get($this->notification->data, 'image'),
                    ]
                )
                ->send();
        }
    }
}
