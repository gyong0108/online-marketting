<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Trackinguuid
 *
 * @package App
 * @property string $country
 * @property string $language
 * @property string $resolution
 * @property tinyInteger $javascript
 */
class Trackinguuid extends Model
{
    protected $fillable = ['country', 'language', 'resolution', 'javascript', 'updating_by', 'uuid' , 'client_id', 'domain_key'];
    protected $direct = false;

    public static $searchable = [
    ];

    public static function boot()
    {
        parent::boot();

        Trackinguuid::observe(new \App\Observers\UserActionsObserver);
    }

    public function newQuery()
    {
        /*if ($this->direct) {
            return parent::newQuery();
        }*/
       /* if (request()->segment(1) == 'api') {
            return parent::newQuery()->where('client_id', auth('api')->user()->client_id);
        } else {
            return parent::newQuery()->where('client_id', auth()->user()->client_id);
        }*/
        return parent::newQuery();
    }

    public function setDirect($input)
    {
        $this->direct = $input;
    }

}
