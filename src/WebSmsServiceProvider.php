<?php

namespace Websms\LaravelNotification;

use Websms\WebSmsApi;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Handler\CurlHandler;
use GuzzleHttp\Client as HttpClient;
use Illuminate\Support\ServiceProvider;


class WebSmsServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {

    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        $this->app->when(WebSmsChannel::class)
            ->needs(WebSmsApi::class)
            ->give(function (){
                return new WebSmsApi(
                    config('services.websms.username'),
                    config('services.websms.password')
                );
            });
    }
}
