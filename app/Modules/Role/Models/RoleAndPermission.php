<?php

namespace App\Modules\Role\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Model;


class RoleAndPermission extends Model
{
    use Notifiable;

    protected $fillable=['role_id','permission_id'];
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    public function permission($name)
    {
        return Permission::where('module_name',$name)->get();
    }
}
