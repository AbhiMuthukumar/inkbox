<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
use App\Picking_data;

Route::get('/', 'analyticsController@index');

Route::get('/overall_breakdown', 'analyticsController@overall_breakdown');

Route::get('/overall_breakdown_with_date', 'analyticsController@overall_breakdown_with_date');

Route::get('/picking_leader_board', 'analyticsController@picking_leader_board');

Route::get('/picking_leader_board/{order_date}', 'analyticsController@leader_board_data');

Route::get('/order_summary', 'analyticsController@order_summary');
