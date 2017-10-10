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
        'firstname','lastname','phone', 'email', 'quantity', 'link_token', 'details', 'status'
    ];

    /**
    * Devuelve los pagos filtrado por el estatus de los mismos
    * @param query $query
    * @param string $status
    */
    public function scopeStatus($query, $status)
    {
    	return $query->where('status' , $status);
    }

    /**
    * devuelve el total de los pagos hechos en un rango de fechas
    * @param string $query
    * @param int $month
    * @param int $year
    */

    public function scopeMonthlySales($query,$month,$year)
    {
        return $query->whereMonth('created_at','=',$month)
                     ->whereYear('created_at','=',$year);
    }
    /**
    * devuelve la entrada asociada en la tabla tokens
    */
    public function token()
    {
        return $this->hasOne('App\Tokens');
    }
}
