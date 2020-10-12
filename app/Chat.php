<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
class Chat extends Model
{
    protected $guarded = [];

    protected $dates = [
        'created_at',
    ];

    public function user(){

        return $this->belongsTo(User::class);
        
    }


    public function getCreatedAtAttribute($date)
	{
	    return Carbon::parse($date)->timezone('Asia/Kolkata')->format('d M,  h:i a');
	}


}
