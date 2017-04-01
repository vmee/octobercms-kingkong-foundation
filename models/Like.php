<?php namespace Kingkong\Foundation\Models;

use Model;

/**
 * Model
 */
class Like extends Model
{
    use \October\Rain\Database\Traits\Validation;

    protected $fillable = ['user_id'];
    /*
     * Validation
     */
    public $rules = [
    ];

    /*
     * Disable timestamps by default.
     * Remove this line if timestamps are defined in the database table.
     */
    public $timestamps = true;

    /**
     * @var string The database table used by the model.
     */
    public $table = 'kingkong_foundation_likes';

    public $morphTo = [
        'like' => []
    ];

}