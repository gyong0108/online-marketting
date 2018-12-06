<?php
namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Trackingevent
 *
 * @package App
 * @property string $uuid
 * @property string $page
 * @property string $eventcategory
 * @property string $eventaction
 * @property string $eventlabel
 * @property integer $eventvalue
*/
class Trackingevent extends Model
{
    protected $fillable = ['eventcategory', 'eventaction', 'eventlabel', 'eventvalue', 'uuid_id', 'page_id', 'updating_by'];
    public static $searchable = [
    ];
    protected  $direct = false;

    public static function boot()
    {
        parent::boot();

        Trackingevent::observe(new \App\Observers\UserActionsObserver);
    }

    /**
     * Set to null if empty
     * @param $input
     */
    public function setUuidIdAttribute($input)
    {
        $this->attributes['uuid_id'] = $input ? $input : null;
    }

    /**
     * Set to null if empty
     * @param $input
     */
    public function setPageIdAttribute($input)
    {
        $this->attributes['page_id'] = $input ? $input : null;
    }

    /**
     * Set attribute to money format
     * @param $input
     */
    public function setEventvalueAttribute($input)
    {
        $this->attributes['eventvalue'] = $input ? $input : null;
    }

    public function uuid()
    {
        return $this->belongsTo(Trackinguuid::class, 'uuid_id');
    }

    public function page()
    {
        return $this->belongsTo(Trackingpage::class, 'page_id');
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

    public function campaigns()
    {
        return $this->hasMany(Trackingcampaign::class, 'uuid_id', 'uuid_id');
    }
}
