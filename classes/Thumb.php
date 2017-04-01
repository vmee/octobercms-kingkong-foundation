<?php
/**
 * Created by PhpStorm.
 * User: kingkong
 * Date: 2017/2/24
 * Time: 下午3:27
 */

namespace Kingkong\Foundation\Classes;

use System\Models\File;
use Kingkong\Foundation\Models\Setting;

class Thumb
{
    use \October\Rain\Support\Traits\Singleton;

    public function url($file)
    {
        if ($file instanceof File) {

        }else{
            $file = Setting::instance()->default_thumb;
        }

        return $this->makeUrl($file);

    }

    public function avatar($file)
    {
        if ($file instanceof File) {

        }else{
            $file = Setting::instance()->default_avatar;
        }

        return $this->makeUrl($file);
    }

    protected function makeUrl($file){

        if(!$file){
            return '';
        }

        return url('api/v1/thumb/'.bin2hex($file->id));
    }



}