<?php


interface INotification {
    public function notify(): string;
}

class Notification implements INotification {
    private string $message;
    public function __construct(string $message){
        $this->message = $message;
    }
    public function notify(): string
    {
        return $this->message;
    }
}

abstract class Decorator implements INotification
{
    protected $notification = null;

    public function __construct(INotification $notification)
    {
        $this->notification = $notification;
    }
}

class Sms extends Decorator
{
    public function notify(): string
    {
        return $this->notification->notify() .';'. 'logic for sending sms';
    }
}

class Email extends Decorator
{
    public function notify(): string
    {
        return $this->notification->notify() .';'. 'logic for sending email';
    }
}

class CN extends Decorator
{
    public function notify(): string
    {
        return $this->notification->notify() .';'. 'logic for sending Chrome Notification';
    }
}

function notify(string $message): string
{
    $notifier =
        new Sms(
            new Email(
                new CN(
                    new Notification($message)
                )
            )
        );
    return $notifier->notify();
}

echo notify('test message');