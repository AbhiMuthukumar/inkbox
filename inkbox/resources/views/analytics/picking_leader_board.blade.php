@extends('layouts.home')

@section('content')

  <h2>Picking Leader Board</h2>

  <div>
    <i class="fa fa-calendar" aria-hidden="true"></i>&nbsp;&nbsp;
    <input type="date" id="order_date"> &nbsp;&nbsp;&nbsp;
    <input type="button" class="btn btn-sm btn-default" id="get_leader_board" value="Submit" onclick="generate_leader_board()">
  </div>
  <br><br>
  <div id="graph_picking_leader_board" style="min-width: 310px; height: 400px; margin: 0 auto"></div>
@stop