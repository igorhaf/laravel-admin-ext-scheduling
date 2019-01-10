<?php

namespace Encore\Admin\Scheduling;

use Illuminate\Support\ServiceProvider;

class SchedulingServiceProvider extends ServiceProvider
{
    /**
     * {@inheritdoc}
     */
    public function boot(Scheduling $extension)
    {
        if (! Scheduling::boot()) {
            return ;
        }

        if ($views = $extension->views()) {
            $this->loadViewsFrom($views, 'scheduling');
        }

        if ($this->app->runningInConsole() && $assets = $extension->assets()) {
            $this->publishes(
                [$assets => public_path('vendor/igorhaf/scheduling')],
                'products'
            );
        }

        $this->app->booted(function () {
            Scheduling::routes(__DIR__.'/../routes/web.php');
        });
    }
}
