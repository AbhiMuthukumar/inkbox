@extends('layouts.home')

@php
 function secondsToTime($ss) {

    /*$dtF = new \DateTime('@0');
    $dtT = new \DateTime("@$seconds");
    return $dtF->diff($dtT)->format('%a days %h hours %i minutes %s seconds');*/

    $s = $ss%60;
    $m = floor(($ss%3600)/60);
    $h = floor(($ss%86400)/3600);
    $d = floor(($ss%2592000)/86400);

    $s = $s < 10 ? '0' . $s : $s;
    $m = $m < 10 ? '0' . $m : $m;
    $h = $h < 10 ? '0' . $h : $h;
    $d = $d < 10 ? '0' . $d : $d;

    return "$d : $h : $m : $s";
  }
@endphp

@section('content')
  @php ($picker_count_map = array())
  @foreach ($picker_count as $picker)
    @php ($picker_count_map[$picker->date_of_order] = $picker->counts)
  @endforeach


  <h2>Overall Breakdown with Date</h2>
  <br>
  <table class="table table-bordered" >
    <tr>
      <th class="col-xs-1">Date of Order</th>
      <th class="col-xs-1"> Picker ID </th>
      <th class="col-xs-1">Counts</th>
      <th class="col-xs-2">Total Elapsed Time <br>(DD : HH : MM : SS)</th>
      <th class="col-xs-2">Average Time per Order <br>(DD : HH : MM : SS)</th>
    </tr>
     @php ($current_date = "")
     @foreach ($orders as $order)
     @php ($average_time = round($order->total_elapsed_time / $order->counts))
     @php ($elapsed_time = $order ->total_elapsed_time)
     <tr>
        @if ($current_date != $order->date_of_order)
          @php ($current_date = $order->date_of_order)
          <td rowspan="{{$picker_count_map[$order->date_of_order]}}">
            {{date_format(date_create($order->date_of_order), 'd M Y')}}
          </td>
        @endif
        <td> {{$order ->picker}}</td>
        <td> {{$order ->counts}}</td>
        <td> {{secondsToTime($elapsed_time)}}</td>
        <td> {{secondsToTime($average_time)}}</td>
      </tr>
    @endforeach
  </table>
@stop