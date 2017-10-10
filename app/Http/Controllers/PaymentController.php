<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Stripe;
use App\Links;
use App\Tokens;

class PaymentController extends Controller
{
	protected $stripeKey;          // Stripe Secret Key

	public function __construct()
	{
		// Stripe secret key
		$this->stripeKey =  env('STRIPE_SECRET');
	}
    
    /**
    * Inicia el proceso de pago con la tarjeta
    * @param string $token El token unico que identifica el pago en la base de datos
    * @param string $email Correo electronico asociado al pago
    * @return view stripe/index.blade.php
    */
    public function index($token, $email)
    {
    	$data  = Links::where('email',$email)
    								->where('link_token',$token)
    								->where('status','waiting')
    								->first();
        
    	if ( !is_null($data) ) {
    		return view('stripe_public.index', compact('data'));
    	} else {
    		return view('errors.exception')->withMessage('El pago no existe o ya ha sido pagado.');
    	}
    	
    }

    /**
    * @param object $request
    * @param string $token El token unico que identifica el pago en la base de datos
    * @param string $email Correo electronico asociado al pago
    */

    public function validatePayment(Request $request, $token, $email)
    {
    	$payData = [];
        $link  = Links::where('email',$email)->where('link_token',$token)->first();

    	request()->validate([
    		'stripeToken' => 'required'
            
    	]);

    	$payData['stripeToken'] = $request->stripeToken;       // token creado por Stripe
    	$payData['amount'] = number_format($link->quantity,2);
    	$payData['email'] = $link->email;                    // email asociado al enlace de pago
    	$payData['linkToken'] = $link->link_token;                // token asociado al enlace de pago
        
        // evitar pago duplicado
        if ($link->status === 'waiting') {
        	$this->makePayment($payData);
        	return view('stripe_public.succeeded', compact('link'));
        } else {
        	$message = "Este paga ya ha sido procesado una vez";
        	return view('errors.exception')->withMessage($message);
        }
    	
    }

    /**
    * @param array $payData Todos los datos necesarios para procesar el pago con Stripe
    */
    private function makePayment($payData)
    {
    	// Stripe object
    	$stripe = Stripe::make($this->stripeKey);
        
        try {
        	$charge = $stripe->charges()->create([
	    		'card'     => $payData['stripeToken'],
			    'currency' => 'EUR',
			    'amount'   => $payData['amount'],
			]);
        } catch (Exception $e){
        	$e->getMessage();
        }
        
        if ($charge['status'] === 'succeeded') {
        	// el pago se ha realizado de manera corecta

        	// recupero el pago y actualizo el estado
            $link = Links::where('link_token', $payData['linkToken'])->where('email', $payData['email'])->first();
            $link->status = $charge['status'];
            $link->save();

            // una vez realizado el pago paso el id del pago a la 

            // tabla Tokens para asociarlo con el token de Stripe

            Tokens::create(['stripe_token' => $payData['stripeToken'], 'links_id' => $link->id]);

        } else {
        	$message =  "Ha ocurrido el siguiente error en el pago, status: ". $charge['status'];
        	return view('errors.exception')->withMessage($message);
        }
    	
    }
}