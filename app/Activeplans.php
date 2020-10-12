<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Activeplans extends Model
{
    protected $fillable = [
        'user_id', 'plan_id','start','end','payment_id'
    ];

    public $sortable = ['user_id','plan_id','start','end'];
    protected $table ="active_plans";

    public function users()
    {
        return $this->hasOne('App\User');
    }
}
