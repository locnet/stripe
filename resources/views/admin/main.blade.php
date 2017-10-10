@extends('admin_master')

@section('title', 'Applicacion pago | Romfly Viajes')

@section('content')

<div class="row">
	<div class="col-md-5 col-xs-12">
        <div id="linkschart"></div>
    </div>
    <div class="col-md-7 col-xs-12">
        <div id="paymentschart"></div>
    </div>
	
</div>

@stop

@section('customjs')
<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
        google.charts.load("current", {packages:["corechart"]});
        google.charts.setOnLoadCallback(drawChart);

        function drawChart() {
          var data = google.visualization.arrayToDataTable([
            ['Task', 'Pagos'],
            ['Finalizados',     {{ App\Links::status('succeeded')->count() }}],
            ['Pendientes',  {{ App\Links::status('waiting')->count() }}]
            ]);

	        var options = {
	            title: 'Situacion pagos',
	            pieHole: 0.4,
	        };

	        var chart = new google.visualization.PieChart(document.getElementById('linkschart'));
	        chart.draw(data, options);
        }
        // año en curso
        {{ $year = Carbon\Carbon::now()->year }}

        // grafico venta por meses
        google.charts.setOnLoadCallback(drawBookingChart);
        function drawBookingChart() {
          var data = google.visualization.arrayToDataTable([
            ['Task', 'Ventas €'],
            ['Enero',      {{ App\Links::monthlySales(1, $year)->sum('quantity') }}],
            ['Febrero',    {{ App\Links::monthlySales(2, $year)->sum('quantity') }}],
            ['Marzo',      {{ App\Links::monthlySales(3, $year)->sum('quantity') }}],
            ['Abril',      {{ App\Links::monthlySales(4, $year)->sum('quantity') }}],
            ['Mayo',       {{ App\Links::monthlySales(5, $year)->sum('quantity') }}],
            ['Junio',      {{ App\Links::monthlySales(6, $year)->sum('quantity') }}],
            ['Julio',      {{ App\Links::monthlySales(7, $year)->sum('quantity') }}],
            ['Agosto',     {{ App\Links::monthlySales(8, $year)->sum('quantity') }}],
            ['Septiembre', {{ App\Links::monthlySales(9, $year)->sum('quantity') }}],
            ['Octubre',    {{ App\Links::monthlySales(10, $year)->sum('quantity') }}],
            ['Noviembre',  {{ App\Links::monthlySales(11, $year)->sum('quantity') }}],
            ['Diciembre',  {{ App\Links::monthlySales(12, $year)->sum('quantity') }}]
            ]);

            var options = {
                title: 'Pagos por mes',
                pieHole: 0.4,
            };

            var chart = new google.visualization.BarChart(document.getElementById('paymentschart'));
            chart.draw(data, options);
        }
    </script>
@endsection