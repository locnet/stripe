<!DOCTYPE html>
<html>
    <head>
        <title>Pago realizado corectamente.</title>

        <link href="https://fonts.googleapis.com/css?family=Lato:100" rel="stylesheet" type="text/css">

        <style>
            html, body {
                height: 100%;
            }

            body {
                margin: 0;
                padding: 0;
                width: 100%;
                color: #505354;
                display: table;
                font-weight: 100;
                font-family: 'Lato';
            }

            .container {
                text-align: center;
                display: table-cell;
                vertical-align: middle;
            }

            .content {
                text-align: center;
                display: inline-block;
            }

            .title {
                font-size: 72px;
                margin-bottom: 40px;
            }
        </style>
    </head>
    <body>
        <div class="container">
            <div class="content">
                <div class="title">¡Felicidades!</div>
                <div>
                    <h2>El pago de {{ number_format($link->quantity, 2) }} € se ha realizado de forma corecta.</h2>
                    <h3>Se ha mandado a {{ $link->email }} un correo de confirmacion del pago.</h3>
                </div>
            </div>
        </div>
    </body>
</html>
