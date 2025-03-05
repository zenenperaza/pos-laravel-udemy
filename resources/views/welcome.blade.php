<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>POS | Laravel</title>

  <link rel='shortcut icon' type='image/x-icon' href='{{ url('storage/plantilla/icono-blanco.png') }}' />
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">

  <meta name="csrf-token" content="{{ csrf_token() }}">
  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="{{ url('bower_components/bootstrap/dist/css/bootstrap.min.css') }}">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{ url('bower_components/font-awesome/css/font-awesome.min.css') }}">
  <!-- Ionicons -->
  <link rel="stylesheet" href="{{ url('bower_components/Ionicons/css/ionicons.min.css') }}">
  <!-- jvectormap -->
  <link rel="stylesheet" href="{{ url('bower_components/jvectormap/jquery-jvectormap.css') }}">
  
  <!-- DATATABLES -->
  <link rel="stylesheet" href="{{ url('bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css') }}">
  <link rel="stylesheet" href="{{ url('bower_components/datatables.net-bs/css/responsive.bootstrap.min.css') }}">

    <!-- ICHECK -->
  <link rel="stylesheet" href="{{ url('bower_components/iCheck/all.css') }}">

  <!-- Theme style -->
  <link rel="stylesheet" href="{{ url('dist/css/AdminLTE.min.css') }}">
  <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
  <link rel="stylesheet" href="{{ url('dist/css/skins/_all-skins.min.css') }}">

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->

  <!-- Google Font -->
  <link rel="stylesheet"  href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">

<!-- Sparkline -->
    {{-- <script src="{{ url('bower_components/jquery/jquery-3.7.1.js') }}"></script> --}}
    <!-- jQuery 3 -->
    <script src="{{ url('bower_components/jquery/dist/jquery.min.js') }}"></script>
    <!-- Bootstrap 3.3.7 -->
    <script src="{{ url('bower_components/bootstrap/dist/js/bootstrap.min.js') }}"></script>
    <!-- ICheck -->
    <script src="{{ url('bower_components/iCheck/icheck.min.js') }}"></script>
    <!-- input mask -->
    {{-- <script src="{{ url('bower_components/input-mask/jquery.inputmask.js') }}"></script>
    <script src="{{ url('bower_components/input-mask/jquery.inputmask.date.extensions.js') }}"></script>
    <script src="{{ url('bower_components/input-mask/jquery.inputmask.extensions.js') }}"></script> --}}
    <!-- InputMask -->
    <script src="{{ url('bower_components/moment/moment.min.js') }}"></script>
    <script src="{{ url('bower_components/inputmask/jquery.inputmask.min.js') }}"></script>

    <!-- ChartJS -->
    <script src="{{ url('bower_components/chart.js/Chart.js') }}"></script>
</head>
<body class="hold-transition skin-blue sidebar-mini login-page">

  @if (Auth::user())
    
  <div class="wrapper">

    @include('modulos.users.cabecera')
      <!-- Left side column. contains the logo and sidebar -->
    @include('modulos.users.menu')

    @yield('contenido')

  </div>

  @else

    @yield('ingresar')
    
  @endif







<!-- FastClick -->
<script src="{{ url('bower_components/fastclick/lib/fastclick.js') }}"></script>
<!-- AdminLTE App -->
<script src="{{ url('dist/js/adminlte.min.js') }}"></script>
<!-- Sparkline -->
<script src="{{ url('bower_components/jquery-sparkline/dist/jquery.sparkline.min.js') }}"></script>
<!-- jvectormap  -->
<script src="{{ url('bower_components/jvectormap/jquery-jvectormap.js') }}"></script>
{{-- <script src="{{ url('bower_components/jvectormap/jquery-jvectormap-world-mill-en.js') }}"></script> --}}
<!-- SlimScroll -->
<script src="{{ url('bower_components/jquery-slimscroll/jquery.slimscroll.min.js') }}"></script>
<!-- ChartJS -->
<script src="{{ url('bower_components/chart.js/Chart.js') }}"></script>
<script src="{{ url('bower_components/morris.js/morris.js') }}"></script>
<script src="{{ url('bower_components/raphael/raphael.js') }}"></script>

<!-- DATATABLES -->
<script src="{{ url('bower_components/datatables.net/js/jquery.dataTables.min.js') }}"></script>
<script src="{{ url('bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js') }}"></script>
<script src="{{ url('bower_components/datatables.net-bs/js/dataTables.responsive.min.js') }}"></script>
<script src="{{ url('bower_components/datatables.net-bs/js/responsive.bootstrap.min.js') }}"></script>

<script src="{{ url('js/plantilla.js') }}"></script>
<script src="{{ url('js/usuarios.js') }}"></script>
<script src="{{ url('js/productos.js') }}"></script>
<script src="{{ url('js/clientes.js') }}"></script>
<script src="{{ url('js/ventas.js') }}"></script>

<!-- sweet alert 2 -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>



<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="{{ url('dist/js/pages/dashboard2.js') }}"></script>
<!-- AdminLTE for demo purposes -->
<script src="{{ url('dist/js/demo.js') }}"></script>



@if (session('success'))
    <script type="text/javascript">
      Swal.fire({
        title: "{{ session('success') }}",
        icon: "success",
        confirmButtonText: "Aceptar"
      });
    </script>
  
@endif

@php
  $exp = explode('/', $_SERVER['REQUEST_URI']);

@endphp


@if ($exp[3] == 'Reportes' || $exp[3] == 'ReportesFiltrados')

  @php

  // dd($noRepetirFechas);

  foreach($noRepetirFechas as $fecha){
      
    $ventas = $sumaPagoMes[$fecha] ?? 0;

    echo "{ y: '".$fecha."', ventas: ".$ventas." },";
  }

  @endphp

    <script type="text/javascript">

    //PRIMER GRAFICO
      var line = new Morris.Line({

        element: 'line-chart-ventas',
        resize: true,
        data: [
          
          @php
            
            foreach($noRepetirFechas as $fecha){
                
              $ventas = $sumaPagoMes[$fecha] ?? 0;

              echo "{ y: '".$fecha."', ventas: ".$ventas." },";
            }

          @endphp

        ],

        xkey: 'y',
        ykeys: ['ventas'],
        labels: ["Ventas"],
        lineColors: ["blue"],
        hideHover: 'auto'
        
      })

      //SEGUNDO GRAFICO
      var coloresFijos = [
        '#f56954',
        '#00a65a',
        '#f39c12',
        '#00c0ef',
      ]

        var pieData = [

        @foreach($productosMasVendidos as $index => $producto)        
        {
            value: {{ $producto->venta }},
            color: coloresFijos[{{ $index }} % coloresFijos.length],
            highlight: coloresFijos[{{ $index }} % coloresFijos.length],
            label: '{{ $producto->descripcion }}'
          },          
        @endforeach

     

       
        ]

        var pieOptions = {

            //Boolean - Whether we should show a stroke on each segment
            segmentShowStroke    : true,
            //String - The colour of each segment stroke
            segmentStrokeColor   : '#fff',
            //Number - The width of each segment stroke
            segmentStrokeWidth   : 2,
            //Number - The percentage of the chart that we cut out of the middle
            percentageInnerCutout: 50, // This is 0 for Pie charts
            //Number - Amount of animation steps
            animationSteps       : 100,
            //String - Animation easing effect
            animationEasing      : 'easeOutBounce',
            //Boolean - Whether we animate the rotation of the Doughnut
            animateRotate        : true,
            //Boolean - Whether we animate scaling the Doughnut from the centre
            animateScale         : false,
            //Boolean - whether to make the chart responsive to window resizing
            responsive           : true,
            // Boolean - whether to maintain the starting aspect ratio or not when responsive, if set to false, will take up entire container
            maintainAspectRatio  : true,

          };

          var pieChartCanvas = $("#pieChart").get(0).getContext('2d');
          var pieChart = new Chart(pieChartCanvas);
          pieChart.Doughnut(pieData, pieOptions);

          //TERCER GRAFICA
          var bar = new Morris.Bar({
            element: 'bar-chart1',
            resize: true,
            data: [
             <?php
                foreach($noRepetirNombres as $value){

                  echo "{ y: '".$value."', a: '".$sumaTotalVendedores[$value]."' },";
                }
             ?>
            ],
            barColors: ['#00a65a'],
            xkey: 'y',
            ykeys: 'a',
            labels: ['Ventas'],
            hideHover: 'auto'
          });


          //CUARTO GRAFICO
          var bar = new Morris.Bar({
            element: 'bar-chart2',
            resize: true,
            data: [
             <?php
                foreach($noRepetirClientes as $value){

                  echo "{ y: '".$value."', a: '".$sumaTotalClientes[$value]."' },";
                }
             ?>
            ],
            barColors: ['#f6a'],
            xkey: 'y',
            ykeys: 'a',
            labels: ['Ventas'],
            hideHover: 'auto'
          });
    
    </script>
    
@endif



@if ($exp[3] == 'Inicio')

  @php

  // dd($noRepetirFechas);

  foreach($noRepetirFechas as $fecha){
      
    $ventas = $sumaPagoMes[$fecha] ?? 0;

    echo "{ y: '".$fecha."', ventas: ".$ventas." },";
  }

  @endphp

    <script type="text/javascript">

    //PRIMER GRAFICO
      var line = new Morris.Line({

        element: 'line-chart-ventas',
        resize: true,
        data: [
          
          @php
            
            foreach($noRepetirFechas as $fecha){
                
              $ventas = $sumaPagoMes[$fecha] ?? 0;

              echo "{ y: '".$fecha."', ventas: ".$ventas." },";
            }

          @endphp

        ],

        xkey: 'y',
        ykeys: ['ventas'],
        labels: ["Ventas"],
        lineColors: ["blue"],
        hideHover: 'auto'
        
      })

      //SEGUNDO GRAFICO
      var coloresFijos = [
        '#f56954',
        '#00a65a',
        '#f39c12',
        '#00c0ef',
      ]

        var pieData = [

        @foreach($productosMasVendidos as $index => $producto)        
        {
            value: {{ $producto->venta }},
            color: coloresFijos[{{ $index }} % coloresFijos.length],
            highlight: coloresFijos[{{ $index }} % coloresFijos.length],
            label: '{{ $producto->descripcion }}'
          },          
        @endforeach

     

       
        ]

        var pieOptions = {

            //Boolean - Whether we should show a stroke on each segment
            segmentShowStroke    : true,
            //String - The colour of each segment stroke
            segmentStrokeColor   : '#fff',
            //Number - The width of each segment stroke
            segmentStrokeWidth   : 2,
            //Number - The percentage of the chart that we cut out of the middle
            percentageInnerCutout: 50, // This is 0 for Pie charts
            //Number - Amount of animation steps
            animationSteps       : 100,
            //String - Animation easing effect
            animationEasing      : 'easeOutBounce',
            //Boolean - Whether we animate the rotation of the Doughnut
            animateRotate        : true,
            //Boolean - Whether we animate scaling the Doughnut from the centre
            animateScale         : false,
            //Boolean - whether to make the chart responsive to window resizing
            responsive           : true,
            // Boolean - whether to maintain the starting aspect ratio or not when responsive, if set to false, will take up entire container
            maintainAspectRatio  : true,

          };

          var pieChartCanvas = $("#pieChart").get(0).getContext('2d');
          var pieChart = new Chart(pieChartCanvas);
          pieChart.Doughnut(pieData, pieOptions);


    
    </script>
    
@endif



</body>
</html>



