@extends('stripe_public.main')

@section('content')
    <div class="row">
        <div class="col-md-8 col-md-offset-2 col-xs-12">
            <h3 class="lato-100 text-center">Pasarela pago seguro Romfly Viajes</h3>
            <h4 class="rotobo">Vas ha pagar la suma de {{ $data->quantity }} € en un entorno seguro. Los datos de tu tarjeta de
            credito seran encriptados a traves de SSL entre el servidor y la pagina web.</h4>
            <div class="text-center" style="padding: 50px 0 50px 0"> 
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
                        data-label="Pagar con la tarjeta bancaria"
                        data-currency="eur">
                    </script>
                </form>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12 col-xs-12">
            <h3 class="lato-300">Formas de pago.</h3>
            <p class="roboto">
                Para proceder al pago, el Cliente deberá seguir todas y cada una de las instrucciones que se muestren en la web.
            </p>
            <p class="roboto">La presente pagina web sirve para hacer un pago exclusivamente mediante tarjeta bancaria.</p>
            <p class="roboto">Para llevar a cabo el pago electrónico, Romfly Viajes utiliza la pasarea de pago Stripe. Todos los datos proporcionados a Romfly Viajes, son debidamente cifrados para garantizar la máxima seguridad y confidencialidad de los mismos, alojándose en un servidor seguro certificado según el protocolo "Secure Socket Layer" (SSL).</p>
            <p class="roboto">En ningún caso se almacenarán por parte de Romfly Viajes los datos de tarjetas proporcionados por los Clientes a través de la pasarela de pago, y únicamente se conservarán mientras se efectúa la compra, se realiza el pago y hasta transcurrido el período de desistimiento, con el fin de poder devolverle las cantidades económicas correspondientes.</p>
        </div>
    </div>      
@stop