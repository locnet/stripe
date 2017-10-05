<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Links;
use App\Payments;
use Mail;

class StripeController extends Controller
{
    //
    public function __constructor() 
    {
    	
    }

    public function index()
    {
        return view('admin.stripe.create');
    }

    /**
    * Store a new payment link
    * @param $request, Request
    */
    public function store(Request $request)
    {
        $validatedData = request()->validate([
			        	'firstname' => 'required|min:6',
			            'lastname' => 'required|min:6',
			            'phone'    => 'required|numeric|min:9',
			            'email'    => 'required|email',
			            'quantity' => 'required|numeric',
			            'details'  =>  'required']);
        
        // random token
        $validatedData['token'] = str_random(32);

        if ($link = Links::firstOrCreate($validatedData))  {
        	// enlace de pago creado corectamente
        	// mandamos el email con los datos del pago
        	$this->sendPaymentEmail($validatedData['token']);

        	return view('admin.stripe.success', compact('link'));
        }
        return "excepcion";
    }


    public function makePayment($token,$email)
    {
    	$link = Links::where('token',$token)->first();

    	if($link->count() > 0) {
    		dd($link);
    	}
    }

     /**
    * Send the confirmacion email
    * @param $link, object
    */
    private function sendPaymentEmail($token) 
    {

    	$link = Links::where('token',$token)->first();

        if ($link->count() > 0) { 

            Mail::send('email.pay_link', ['link' => $link], function($message) use ($link)
            {
                $message->to($link->email, 'Romfly Viajes')
                        ->subject('Pago reserva avion');
            });

            return view('auth.success_message', compact('user'));
        } else {
            return view('errors.user_error')->withMessage('Ha ocurido un error inesperado, por favor 
                vuelve al correo electronico y intentalo otra vez. Si el error persiste mandanos un 
                email al info@andalsiandoviaggi.com.');
        }
        
    }
}