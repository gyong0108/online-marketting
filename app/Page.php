<?php
namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Traits\FilterByUser;
use App\User;
use App\Owner;
/**
 * Class Page
 *
 * @package App
 * @property string $adgroup
 * @property string $name
 * @property string $logo
 * @property string $image
 * @property text $information
 * @property text $about
 * @property string $youtube_url
 * @property text $youtube_text
 * @property text $html
 * @property string $created_by
*/
class Page extends Model
{
    use SoftDeletes, FilterByUser;

    protected $fillable = ['name', 'logo', 'image', 'information', 'about', 'youtube_url', 'youtube_text', 'adgroup_id', 'created_by_id','imprint','privity','conditions','winninggame','maincolor','template_id','domain','subdomain','is_subdomain','link_url','link_text','background_image','title1','title2','description','longdescription','footer','is_index','facebook','twitter','xing','linkedin','skype'];
    protected $hidden = [];
    
    public function getUser(){
        $user_id = $this->created_by_id;
        return User::find($user_id);

    }
    public function getOwner(){
        $user  = $this->getUser();
        return $owner = Owner::find($user->owners_id);

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
     * Set to null if empty
     * @param $input
     */
    public function setCreatedByIdAttribute($input)
    {
        $this->attributes['created_by_id'] = $input ? $input : null;
    }
    
    public function adgroup()
    {
        return $this->belongsTo(Adgroup::class, 'adgroup_id')->withTrashed();
    }

    public function template()
    {
        return $this->belongsTo(\App\Template::class,'template_id')->withTrashed();
    }
    
    public function created_by()
    {
        return $this->belongsTo(User::class, 'created_by_id');
    }
    
}
