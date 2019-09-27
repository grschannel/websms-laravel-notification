<?php

namespace Websms\LaravelNotification;


use Illuminate\Notifications\Notification;
use Websms\WebSmsApi;

class WebSmsChannel
{
    protected $api;

    /**
     * WebSmsChannel constructor.
     * @param WebSmsApi $api
     */
    public function __construct(WebSmsApi $api)
    {
        $this->api = $api;
    }

    /**
     * Send the given notification.
     *
     * @param  mixed $notifiable
     * @param  \Illuminate\Notifications\Notification $notification
     * @return void
     * @throws Exception
     */
    public function send($notifiable, Notification $notification)
    {
        /** @var WebSmsMessage $message */
        $message = $notification->toSms($notifiable);

        $this->api->Send($message->getTo(),$message->getFrom(),$message->getMessage());
    }
}