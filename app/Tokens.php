<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tokens extends Model
{
    protected $fillable = ['stripe_token', 'links_id'];

    /**
    * devuelve los datos del enlace al que pertenece (tabla links) este token de Stripe
    */

    public function links() 
    {
    	return $this->belongsTo('App\Links', 'links_id');
    }
}
