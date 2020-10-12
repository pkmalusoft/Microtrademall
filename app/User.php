<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Kyslik\ColumnSortable\Sortable;

class User extends Authenticatable
{
    use Notifiable;
    use Sortable;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email','username','password','role','contact', 'google_id','provider_user_id', 'provider','verification'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'phone_verified_at' => 'datetime',
    ];

    public $sortable = ['id','name','username','role','email','verification'];
    
    protected $with = ['usermeta'];

    // public function roles()
    // {
    //     return $this->belongsToMany('App\Role')->as('user_role');
    // }
    public function usermeta()
    {
        return $this->hasOne('App\UserMeta');
    }

    public function messages(){
        return $this->hasMany(Chat::class);
    }
}
