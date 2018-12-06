<?php
namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Auth\Notifications\ResetPassword;
use Hash;

/**
 * Class User
 *
 * @package App
 * @property string $name
 * @property string $email
 * @property string $password
 * @property string $remember_token
 * @property tinyInteger $approved
 * @property tinyInteger $premium
 * @property string $stripe_customer_id
*/
class User extends Authenticatable
{
    use Notifiable;
    protected $fillable = ['name', 'email', 'password', 'remember_token', 'approved', 'premium', 'stripe_customer_id', 'phone'];
    protected $hidden = ['password', 'remember_token'];


    public static function boot()
    {
        parent::boot();

        User::observe(new \App\Observers\UserActionsObserver);
    }

    /**
     * Hash password
     * @param $input
     */
    public function setPasswordAttribute($input)
    {
        if ($input)
            $this->attributes['password'] = app('hash')->needsRehash($input) ? Hash::make($input) : $input;
    }


    public function role()
    {
        return $this->belongsToMany(Role::class, 'role_user');
    }


    public function internalNotifications()
    {
        return $this->belongsToMany(InternalNotification::class)
            ->withPivot('read_at')
            ->orderBy('internal_notification_user.created_at', 'desc')
            ->limit(10);
    }

    public function sendPasswordResetNotification($token)
    {
       $this->notify(new ResetPassword($token));
    }

    public function getCampaigns(){
        return Request::where('created_by_id', $this->id)->get();
    }
    public function getOwner(){
        $owner = $this->owners_id;
        if($owner){
            return Owner::find($owner);
        }
        else{
            return null;
        }
    }
}
