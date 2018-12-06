<?php
namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Trackingpage
 *
 * @package App
 * @property integer $domain_key
 * @property string $uri
 * @property string $title
*/
class Trackingpage extends Model
{
    protected $fillable = ['domain_key', 'uri', 'title', 'updating_by'];
    public static $searchable = [
    ];
    protected  $direct = false;


    public static function boot()
    {
        parent::boot();

        Trackingpage::observe(new \App\Observers\UserActionsObserver);
    }

    /**
     * Set attribute to money format
     * @param $input
     */
    public function setDomainKeyAttribute($input)
    {
        $this->attributes['domain_key'] = $input ? $input : null;
    }


    public function newQuery()
    {
        if ($this->direct) {
            return parent::newQuery();
        }
        if (request()->segment(1) == 'api') {
            return parent::newQuery()->where('client_id', auth('api')->user()->client_id);
        } else {
            return parent::newQuery()->where('client_id', auth()->user()->client_id);
        }
    }

    public function setDirect($input)
    {
        $this->direct = $input;
    }
}
