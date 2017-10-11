<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Links;
use App\Payments;
use Mail;
use App;

class StripeController extends Controller
{
    
   

    public function index()
    {
        return view('admin.stripe.create');
    }

    /**
    * Devuelve todos los enlaces creados
    */
    public function getAll()
    {
    	$links = Links::get();
    	return view('admin.stripe.view_all',compact('links'));
    }

    /**
    * devuelve los detalles de un enlace
    * @param $id, id del link
    */
    public function getLink($id)
    {
    	$link = Links::find($id);
    	return view('admin.stripe.view_one',compact('link'));
    }

    /**
    * Guarda en la base de datos un nuevo pago
    * @param $request, Request
    */
    public function store(Request $request)
    {
        $validatedData = request()->validate([
			        	'firstname' => 'required|min:3',
			            'lastname' => 'required|min:3',
			            'phone'    => 'required|numeric|min:9',
			            'email'    => 'required|email',
			            'quantity' => 'required|numeric',
			            'details'  =>  'required']);
        
        // no quiero duplicar el pago
        if (  is_null(Links::where('email',$request->email)
        		->where('details',$request->details)
        		->where('quantity',$request->quantity)
        		->first())  ) {
        	
        	$validatedData['link_token'] = str_random(32);     // random token
        	$validatedData['status'] = "waiting";         // status por defecto

	        if ($link = Links::firstOrCreate($validatedData))  {
	        	// el enlace de pago se ha creado corectamente
	        	// mandamos el email con los datos del pago, solo en produccion
	        	if (env('APP_URL') != 'http://localhost') {
				    // The environment isn't local
				    $this->sendPaymentEmail($validatedData['link_token']);
				}	        	

	        	return view('admin.stripe.success', compact('link'));
	        }
	        $message = "El pago no se ha podido insertar en la base de datos.";
        	return view('errors.exception')->withMessage($message);
        } else {
        	$message = "Estas intentando duplicar el enlace de pago";
        	return view('errors.exception')->withMessage($message);
        }       
    }


     /**
    * Send the confirmacion email
    * @param $token, el token de seguridad 
    */
    private function sendPaymentEmail($token) 
    {

    	$link = Links::where('link_token',$token)->first();

        if ($link->count() > 0) { 

            Mail::send('email.pay_link', ['link' => $link], function($message) use ($link)
            {
                $message->to($link->email, 'Romfly Viajes')
                        ->subject('Pago reserva avion');
            });

            return view('auth.success_message', compact('user'));
        } else {
            return view('errors.exception')->withMessage('Ha ocurido un error inesperado, por favor 
                vuelve al correo electronico y intentalo otra vez. Si el error persiste mandanos un 
                email al office@romfly.com.');
        }
        
    }
}