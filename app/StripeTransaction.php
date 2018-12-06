<?php
namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * Class StripeTransaction
 *
 * @package App
 * @property string $transaction_user
 * @property decimal $amount
*/
class StripeTransaction extends Model
{
    protected $fillable = ['amount', 'transaction_user_id'];
    protected $hidden = [];
    
    
    public static function boot()
    {
        parent::boot();

        StripeTransaction::observe(new \App\Observers\UserActionsObserver);
    }

    /**
     * Set to null if empty
     * @param $input
     */
    public function setTransactionUserIdAttribute($input)
    {
        $this->attributes['transaction_user_id'] = $input ? $input : null;
    }

    /**
     * Set attribute to money format
     * @param $input
     */
    public function setAmountAttribute($input)
    {
        $this->attributes['amount'] = $input ? $input : null;
    }
    
    public function transaction_user()
    {
        return $this->belongsTo(User::class, 'transaction_user_id');
    }
    
}
