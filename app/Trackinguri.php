<?php
namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Trackinguri
 *
 * @package App
 * @property string $uuid
 * @property string $page
 * @property integer $pageloadingtime
 * @property integer $timeonpage
 * @property string $referer
*/
class Trackinguri extends Model
{
    protected $fillable = ['pageloadingtime', 'timeonpage', 'referer', 'uuid_id', 'page_id', 'updating_by'];
    public static $searchable = [
    ];
    protected  $direct = false;


    public static function boot()
    {
        parent::boot();

        Trackinguri::observe(new \App\Observers\UserActionsObserver);
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
    public function setPageloadingtimeAttribute($input)
    {
        $this->attributes['pageloadingtime'] = $input ? $input : null;
    }

    /**
     * Set attribute to money format
     * @param $input
     */
    public function setTimeonpageAttribute($input)
    {
        $this->attributes['timeonpage'] = $input ? $input : null;
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
        /*if ($this->direct) {
            return parent::newQuery();
        }
        if (request()->segment(1) == 'api') {
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
