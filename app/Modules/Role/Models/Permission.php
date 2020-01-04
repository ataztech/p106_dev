<?php

namespace App\Modules\Role\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Model;


class Permission extends Model
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    public function permission($name)
    {
        return Permission::where('module_name',$name)->get();
    }

    public function hasRole($role_id,$permission_id)
    {
        $permission = RoleAndPermission::where('role_id',$role_id)->where('permission_id',$permission_id)->first();
        return $permission != '' ? 1:0;
    }
}
