<?php
/**
 * Logger service provider to be able to log in different files
 *
 * @package    App\Core\Logger
 * @author     Phong Tran <jarvis.phongtran@gmail.com>
 */

namespace App\Core\Logger;

use Illuminate\Support\ServiceProvider;

/**
 * Class LogToChannelsServiceProvider
 *
 * @package App\Providers
 */
class LogServiceProvider extends ServiceProvider
{
    /**
     * Initialize the logger
     *
     * @return void
     */
    public function register(): void
    {
        $this->app->singleton('App\Helpers\LogToChannels', function () {
            return new Log();
        });
    }
}
