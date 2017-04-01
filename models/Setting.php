<?php namespace Kingkong\Foundation\Models;

use Model;

/**
 * Setting Model
 */
class Setting extends Model
{
    use \October\Rain\Database\Traits\Validation;

    public $implement = ['System.Behaviors.SettingsModel'];

    public $settingsCode = 'kingkong_foundation_settings';

    public $settingsFields = 'fields.yaml';

    public $attachOne = [
        'default_thumb' => ['System\Models\File'],
        'default_avatar' => ['System\Models\File']
    ];

    public $rules = [
        //'default_thumb' => '',
        //'default_avatar' => '',

        // Need to add required fields from selected gateway, maybe through detecting
        //  recorded gateway (need to record that first !)
        //'clickatell_user_name' => 'required',
        //'clickatell_passwd' => 'required',
        //'clickatell_api_id' => 'required',
        //'clickatell_base_url' => 'required',
    ];
}