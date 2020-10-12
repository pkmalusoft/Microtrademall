<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;

class Service extends Model
{
    
    use Sortable;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'services';

    /**
    * The database primary key value.
    *
    * @var string
    */
    protected $primaryKey = 'id';

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = [
                  'title',
                  'description',
                  'icon',
              ];


    public $sortable = ['title'];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = [];
    
    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [];
    



}
