<?php

namespace Encore\Admin\Scheduling;

use Encore\Admin\Extension;

class Scheduling extends Extension
{
    public $name = 'scheduling';

    public $views = __DIR__.'/../resources/views';

    public $assets = __DIR__.'/../resources/assets';

    public $menu = [
        'title' => 'Scheduling',
        'path'  => 'scheduling',
        'icon'  => 'fa-clock-o',
    ];
}
