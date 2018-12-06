<?php
namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Traits\FilterByUser;

/**
 * Class Campaign
 *
 * @package App
 * @property string $name
 * @property text $keywords
 * @property integer $daily_budget
 * @property string $title
 * @property string $undertitle
 * @property string $shortdescription
 * @property string $description
 * @property string $logo
 * @property string $image
 * @property string $email
 * @property tinyInteger $active
 * @property string $created_by
*/
class Campaign extends Model
{
    use SoftDeletes, FilterByUser;
    protected $table = 'campaigns';
    protected $fillable = ['name', 'keywords', 'daily_budget', 'title', 'undertitle', 'shortdescription', 'description', 'logo', 'image', 'email', 'active', 'created_by_id'];
    protected $hidden = [];


    public static function boot()
    {
        parent::boot();

        Campaign::observe(new \App\Observers\UserActionsObserver);
    }

    /**
     * Set attribute to money format
     * @param $input
     */
    public function setDailyBudgetAttribute($input)
    {
        $this->attributes['daily_budget'] = $input ? $input : null;
    }

    /**
     * Set to null if empty
     * @param $input
     */
    public function setCreatedByIdAttribute($input)
    {
        $this->attributes['created_by_id'] = $input ? $input : null;
    }

    public function created_by()
    {
        return $this->belongsTo(User::class, 'created_by_id');
    }

}
