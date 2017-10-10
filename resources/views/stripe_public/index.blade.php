@extends('stripe_public.main')

@section('content')
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <h3 class="text-center">Pasarela pago seguro Romfly Viajes</h3>
                <h4>Vas ha pagar la suma de {{ $data->quantity }} € </h4>
                <div class="text-center">
                    <form action="{{ url('/confirm/'.$data['link_token'].'/'.$data['email'] ) }}" method="POST">
                        {!! csrf_field() !!}
                        <script
                            src="https://checkout.stripe.com/checkout.js" class="stripe-button"
                            data-key="pk_test_xq28spRMPZ1WBbGMfqcacdOG"
                            data-amount="{{ ($data->quantity * 100) }}"
                            data-name="Romfly Viajes"
                            data-description="Aplicacion de pago Romfly Viajes"
                            data-image="https://stripe.com/img/documentation/checkout/marketplace.png"
                            data-locale="es"
                            data-currency="eur">
                        </script>
                    </form>
                </div>
            </div>
        </div>
    </div>       
@stop