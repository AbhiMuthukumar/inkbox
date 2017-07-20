@extends('layouts.home')

@section('content')

  <h2>Order Summary - Date Vs Orders_Picked</h2>

  <br><br>
  <div id="graph_order_summary" style="min-width: 310px; height: 400px; margin: 0 auto"></div>

  <script type="text/javascript">
    let orders = <?php echo json_encode($orders); ?>;
    let pickers = <?php echo json_encode($pickers); ?>;
    let dates = <?php echo json_encode($dates); ?>;
    generate_order_summary(orders, pickers, dates);
  </script>
@stop