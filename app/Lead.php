<?php
namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Traits\FilterByUser;

/**
 * Class Lead
 *
 * @package App
 * @property string $adgroup
 * @property string $name
 * @property string $email
 * @property string $phone
 * @property string $status
 * @property text $notes
 * @property text $formdata
 * @property string $created_by
*/
class Lead extends Model
{
    use SoftDeletes, FilterByUser;

    protected $fillable = ['notes', 'formdata', 'contact_id', 'status_id', 'is_newsletter','created_by_id'];
    protected $hidden = [];



    /**
     * Set to null if empty
     * @param $input
     */
    public function setStatusIdAttribute($input)
    {
        $this->attributes['status_id'] = $input ? $input : null;
    }

    /**
     * Set to null if empty
     * @param $input
     */
    public function setCreatedByIdAttribute($input)
    {
        if ($input){
            $this->attributes['created_by_id'] = $input ? $input : null;
        }
    }

    public function contact()
    {
        return $this->belongsTo(\App\Contact::class, 'contact_id')->withTrashed();
    }

    public function status()
    {
        return $this->belongsTo(Status::class, 'status_id')->withTrashed();
    }

    public function created_by()
    {
        return $this->belongsTo(User::class, 'created_by_id');
    }

}
