<?php namespace Kingkong\Foundation\Behaviors;

use Db;
use System\Classes\ModelBehavior;
use ApplicationException;
use Exception;
use Kingkong\Foundation\Models\Like;
use Auth;

/**
 * Location model extension
 *
 * Adds Country and State relations to a model
 *
 * Usage:
 *
 * In the model class definition:
 *
 *   public $implement = ['RainLab.Location.Behaviors.LocationModel'];
 *
 */
class LikeModel extends ModelBehavior
{
    public $likeAttribute = 'like';
    /**
     * Constructor
     */
    public function __construct($model)
    {
        parent::__construct($model);

        $this->likeAttribute = isset($model->likeAttribute) ? $model->likeAttribute : $this->likeAttribute;
        $model->morphMany['likes'] = [ 'Kingkong\Foundation\Models\Like', 'name' => 'like'];
    }

    function incrementLike($userId = 0, $force = false)
    {
        if(!$userId){
            $userId = Auth::getUser()->id;
        }

        if(!$userId && !$force) return false;

        if($force){
            return $this->incrementOrDecrement('increment');
        }else{
            if(0 == $this->model->likes()->where('user_id', $userId)->count()){
                $this->model->likes()->add(new Like(['user_id'=>$userId]));
                return $this->incrementOrDecrement('increment');
            }
        }

        return true;

    }

    function decrementLike($userId = 0, $force = false)
    {
        if(!$userId){
            $userId = Auth::getUser()->id;
        }

        if(!$userId ){
            if($force){
                return $this->incrementOrDecrement('decrement');
            }

            return false;
        }

        if($this->model->likes()->where('user_id', $userId)->count() > 0){
            $this->model->likes()->where('user_id', $userId)->delete();
            return $this->incrementOrDecrement('decrement');
        }
        return true;
    }

    protected function incrementOrDecrement($method)
    {
        if($this->likeAttribute){
            return $this->model->{$method}($this->likeAttribute);
        }

        return 1;
    }



}
