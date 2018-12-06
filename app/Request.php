<?php
namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Traits\FilterByUser;

/**
 * Class Request
 *
 * @package App
 * @property string $landingpage
 * @property string $target
 * @property string $city
 * @property string $not_clear
 * @property tinyInteger $no_phonenumber
 * @property tinyInteger $no_email
 * @property tinyInteger $no_form
 * @property tinyInteger $no_content
 * @property tinyInteger $no_faq
 * @property string $adgroup
 * @property string $other_keywords
 * @property string $aswered
 * @property string $created_by
*/
class Request extends Model
{
    use SoftDeletes, FilterByUser;

    protected $fillable = ['landingpage', 'target', 'city', 'not_clear', 'no_phonenumber', 'no_email', 'no_form', 'no_content', 'no_faq', 'other_keywords', 'aswered', 'adgroup_id', 'created_by_id'];
    protected $hidden = [];


    public static function boot()
    {
        parent::boot();

        Request::observe(new \App\Observers\UserActionsObserver);
    }

    /**
     * Set to null if empty
     * @param $input
     */
    public function setAdgroupIdAttribute($input)
    {
        $this->attributes['adgroup_id'] = $input ? $input : null;
    }

    /**
     * Set attribute to date format
     * @param $input
     */
    public function setAsweredAttribute($input)
    {
        if ($input != null && $input != '') {
            $this->attributes['aswered'] = Carbon::createFromFormat(config('app.date_format') . ' H:i:s', $input)->format('Y-m-d H:i:s');
        } else {
            $this->attributes['aswered'] = null;
        }
    }

    /**
     * Get attribute from date format
     * @param $input
     *
     * @return string
     */
    public function getAsweredAttribute($input)
    {
        $zeroDate = str_replace(['Y', 'm', 'd'], ['0000', '00', '00'], config('app.date_format') . ' H:i:s');

        if ($input != $zeroDate && $input != null) {
            return Carbon::createFromFormat('Y-m-d H:i:s', $input)->format(config('app.date_format') . ' H:i:s');
        } else {
            return '';
        }
    }

    /**
     * Set to null if empty
     * @param $input
     */
    public function setCreatedByIdAttribute($input)
    {
        $this->attributes['created_by_id'] = $input ? $input : null;
    }

    public function adgroup()
    {
        return $this->belongsTo(Campaign::class, 'adgroup_id')->withTrashed();
    }

    public function created_by()
    {
        return $this->belongsTo(User::class, 'created_by_id');
    }

}
