<?php namespace Kingkong\Foundation;

use System\Classes\PluginBase;
use App;

class Plugin extends PluginBase
{
    public function registerComponents()
    {
    }

    public function registerSettings()
    {
        return [
            'thumb' => [
                'label' => '基本设置',
                'icon' => 'icon-gears',
                'description' => '基本服务功能设置.',
                'class' => 'Kingkong\Foundation\Models\Setting',
                'order' => 100,
                'permissions' => ['kingkong.foundation_manage'],
            ]
        ];
    }

    public function boot()
    {
        App::singleton('thumb', function() {
            return \Kingkong\Foundation\Classes\Thumb::instance();
        });
    }


}
