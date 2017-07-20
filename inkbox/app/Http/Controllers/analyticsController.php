<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Picking_data;
use DB;

class analyticsController extends Controller
{
    public function index(){
      return redirect('/overall_breakdown');
    }

    public function overall_breakdown(){
      $orders = Picking_data::groupBy('picker')
                -> select('picker', DB::raw('count(order_id) as counts'),
                          DB::raw('SUM(TIME_TO_SEC(TIMEDIFF(updated_at, created_at))) as total_elapsed_time'))
                -> get();
      return view('analytics.overall_breakdown',compact('orders','display_date'));
    }

    public function overall_breakdown_with_date(){
      $orders = Picking_data::groupBy(DB::raw('DATE(created_at)'))
                -> groupBy('picker')
                -> select(DB::raw('DATE(created_at) as date_of_order'), 'picker', DB::raw('count(order_id) as counts'),
                          DB::raw('SUM(TIME_TO_SEC(TIMEDIFF(updated_at, created_at))) as total_elapsed_time'))
                -> get();
      $picker_count = Picking_data::groupBy(DB::raw('DATE(created_at)'))
                -> select(DB::raw('DATE(created_at) as date_of_order'), DB::raw('count(distinct(picker)) as counts'))
                -> get();
      //dd($picker_count);
      return view('analytics.overall_breakdown_date',compact('orders','picker_count'));
    }

    public function picking_leader_board(){
      return view('analytics.picking_leader_board');
    }

    public function leader_board_data($order_date){
      return Picking_data::where(DB::raw('DATE(created_at)'), '=', $order_date)
                ->groupBy('picker')
                ->orderBy(DB::raw('count(order_id)'), 'DESC')
                ->select('picker', DB::raw('count(order_id) as counts'))
                ->get();
    }

    public function order_summary(){
      $orders = Picking_data::groupBy(DB::raw('DATE(created_at)'))
                -> groupBy('picker')
                -> orderBy('picker')
                -> orderBy(DB::raw('DATE(created_at)'))
                -> select(DB::raw('DATE(created_at) as date_of_order'), 'picker', DB::raw('count(order_id) as counts'))
                -> get();
      $pickers = Picking_data::select(DB::raw('distinct(picker)'))
                -> orderBy('picker')
                ->get();
      $dates = Picking_data::select(DB::raw('distinct(DATE(created_at)) as date_of_order'))
                -> orderBy(DB::raw('DATE(created_at)'))
                ->get();
      //dd($orders);
      return view('analytics.order_summary', compact('orders','pickers', 'dates'));
      //return $orders;
    }
}
