<!DOCTYPE html>
<html>
<head>
    <title>Inkbox</title>
    <link href = {{ asset("css/app.css") }} rel="stylesheet" />
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">

    <script src="https://code.highcharts.com/highcharts.js"></script>
    <script src="https://code.highcharts.com/modules/exporting.js"> </script>
    <script
      src="https://code.jquery.com/jquery-3.2.1.min.js"
      integrity="sha256-hwg4gsxgFZhOsEEamdOYGBf13FyQuiTwlAQgxVSNgt4="
      crossorigin="anonymous">
    </script>
    <script type="text/javascript" src="{{asset('js/analytics.js')}}"></script>

</head>
<body>
    <div class="navbar navbar-inverse navbar-fixed-left">
    <p class="navbar-brand">Inkbox</p>
    <ul class="nav navbar-nav">
     <li id="overall_breakdown"><a href="/overall_breakdown">Overall Breakdown</a></li>
     <li id="overall_breakdown_with_date"><a href="/overall_breakdown_with_date">Overall Breakdown with Date</a></li>
     <li id="picking_leader_board"><a href="/picking_leader_board">Picking Leader Board</a></li>
     <li id="order_summary"><a href="/order_summary">Order Summary</a></li>
    </ul>
  </div>
  <div class="container">
   <div class="row">
     @yield('content')
   </div>
</div>
<script type="text/javascript">
  $(`#${window.location.pathname.slice(1)}`).addClass("active");
</script>
</body>
</html>