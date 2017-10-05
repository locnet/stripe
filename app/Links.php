<?php

namespace App;

use Illuminate\Database\Eloquent\Model;



class Links extends Model
{
    

     /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'firstname','lastname','phone', 'email', 'quantity', 'token', 'details'
    ];
}
