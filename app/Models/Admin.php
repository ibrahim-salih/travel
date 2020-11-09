<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laratrust\Traits\LaratrustUserTrait;

class Admin extends Authenticatable
{
    use LaratrustUserTrait;
    use Notifiable;
    protected $table = 'admins';
    
    protected $guarded = [];
    
    public $timestamps = true;
    
    protected $hidden = [
        'password', 'remember_token',
    ];
    
//     public function  getPhotoAttribute($val){
//         return ($val !== null) ? asset('assets/images/users/' . $val) : "";
//     }
    
}
