<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Employee extends Model
{
    //
    use SoftDeletes;
     protected $table = 'employees';
     protected $primaryKey = 'id';
     protected $fillable = [
        'name', 'birthdate', 'sex','salary','job','created_at','updated_at','image'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
         'deleted_at',
    ];
}
