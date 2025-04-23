<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model as EloquentModel;

class Model extends EloquentModel
{
    //
    // protected $table = 'models';
    public $timestamps = false ;
    protected $fillable = [
        'name',
        'maker_id'
    ];
}
