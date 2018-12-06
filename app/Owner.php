<?php
namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Traits\FilterByUser;

/**
 * Class Adgroup
 *
 * @package App
 * @property string $campaign
 * @property string $mainkeyword
 * @property string $created_by
*/
class Owner extends Model
{
	protected $table = 'owners';
}
