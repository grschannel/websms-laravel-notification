# websms-laravel-notification
WebSms Laravel Notification


## Installation
You can install the package via composer:
```php
$ composer require websms/laravel-notification
```
You must install the service provider:

```php
// config/app.php
'providers' => [
    ...
    Websms\LaravelNotification\WebSmsServiceProvider::class,
]
```



## Setting up your WebSms account
Add your WebSms Username, Password and Sender Number to your config/services.php:


```php
// config/services.php

...
'websms' => [
'username' => env('WEBSMS_USERNAME'),
'password' => env('WEBSMS_PASSWORD'),
'sendNumber' => env('WEBSMS_SENDNUMBER'),
],
...
```


```php
// .env

WEBSMS_USERNAME=your_username
WEBSMS_PASSWORD=your_password
WEBSMS_SENDNUMBER=send_number
```


## Usage
Now you can use the channel in your via() method inside the notification:

```php
/**
 * Get the notification's delivery channels.
 *
 * @param  mixed  $notifiable
 * @return array
 */
public function via($notifiable)
{
    return [WebSmsChannel::class];
}

/**
 * Get the sms representation of the notification.
 *
 * @param  mixed  $notifiable
 * @return string
 */
public function toSms($notifiable)
{
    $webSmsMessage = new WebSmsMessage();
    $webSmsMessage->setFrom(env('WEBSMS_SENDNUMBER'));
    $webSmsMessage->setTo($notifiable->routeNotificationFor('sms'));
    $webSmsMessage->setMessage($this->message);

    return $webSmsMessage;
}
```
    
    
In order to let your Notification know which phone number you are sending to, add the routeNotificationForSms method to your Notifiable model e.g your User Model
```php
public function routeNotificationForSms()
{
    return $this->phone; // where `phone` is a field in your users table;
}
```
