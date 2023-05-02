<?php

namespace Dply\CMS\Listeners;

use Illuminate\Contracts\Queue\ShouldQueue;
use Dply\CMS\Events\EmailHook;
use Dply\Backend\Models\EmailTemplate;
use Dply\CMS\Support\Email;

class SendEmailHook implements ShouldQueue
{
    /**
     * Handle the event.
     *
     * @param EmailHook $event
     * @return void
     */
    public function handle(EmailHook $event)
    {
        $params = $event->args['params'] ?? [];
        $to = $event->args['to'] ?? [];
        if (! is_array($to)) {
            $to = [$to];
        }

        $templates = EmailTemplate::where('email_hook', '=', $event->hook)
            ->get();

        foreach ($templates as $template) {
            Email::make()
                ->setEmails($to)
                ->withTemplate($template->code)
                ->setParams($params)
                ->send();
        }
    }
}
