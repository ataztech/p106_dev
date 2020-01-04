<?php

namespace App\Modules\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Model;


class GlobalValue extends Model
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'value'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */

}
