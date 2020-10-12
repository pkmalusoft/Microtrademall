<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Auth;
class UserMeta extends Model
{
    protected $table = 'usermeta';
 	protected $fillable = [
        'user_id','maxinvestment','introduction','location'
    ];

  public function user()
    {
       return $this->belongsTo('App\User','user_id');
    }
}
