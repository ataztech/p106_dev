<?php

namespace App\Modules\Role\Models;

use Illuminate\Database\Eloquent\Model;

class Role extends Model {

    //
    public function permissions()
    {
        return $this->belongsToMany('App\Modules\Role\Models\Permission','role_and_permissions','role_id','permission_id');
    }
}
