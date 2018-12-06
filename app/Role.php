<?php
namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Role
 *
 * @package App
 * @property string $title
 * @property decimal $price
 * @property string $stripe_plan_id
*/
class Role extends Model
{
    protected $fillable = ['title', 'price', 'stripe_plan_id'];
    protected $hidden = [];
    
    
    public static function boot()
    {
        parent::boot();

        Role::observe(new \App\Observers\UserActionsObserver);
    }

    /**
     * Set attribute to money format
     * @param $input
     */
    public function setPriceAttribute($input)
    {
        $this->attributes['price'] = $input ? $input : null;
    }
    
    public function permission()
    {
        return $this->belongsToMany(Permission::class, 'permission_role');
    }
    
}
