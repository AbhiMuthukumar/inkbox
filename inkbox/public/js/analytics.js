function generate_leader_board(){
  var given_date = $("#order_date").val()
  if (given_date == ""){
    alert("Select a date for generating the leader board!");
    return false;
  }
  $.ajax({
    url: "/picking_leader_board/" + given_date,
    method: "GET",
    success: function(response){
      if (Object.keys(response).length > 0){
        draw_graph(response, given_date);
      } else {
        $("#picking_leader_board").text("No Data Found");
      }
    },
    error: function(response){
    }
  });
}
function generate_leader_board(){
  var given_date = $("#order_date").val()
  if (given_date == ""){
    alert("Select a date for generating the leader board!");
    return false;
  }
  $.ajax({
    url: "/picking_leader_board/" + given_date,
    method: "GET",
    success: function(response){
      if (Object.keys(response).length > 0){
        draw_graph(response, given_date);
      } else {
        $("#picking_leader_board").text("No Data Found");
      }
    },
    error: function(response){
      console.log(response);
    }
  });
}
function draw_graph(response, given_date){
  let picker_array = [];
  let count_array =  [];
  response.forEach(function(obj){
    picker_array.push(obj.picker);
    count_array.push(obj.counts);
  });
  Highcharts.chart('graph_picking_leader_board', {
    chart: {
        type: 'line'
    },
    title: {
        text: `Picking Leader Board - ${given_date}`
    },
    xAxis: {
        title: {
          text: 'Picker'
        },
        categories: picker_array
    },
    yAxis: {
        title: {
            text: 'Orders'
        }
    },
    plotOptions: {
        line: {
            dataLabels: {
                enabled: true
            },
            enableMouseTracking: false
        }
    },
    series: [{
        name: 'Count of Orders',
        data: count_array
    }]
  });
}

function generate_order_summary(orders, pickers, dates){
  let date_list = [];
  let order_index = 0;
  let order_list = [];

  dates.forEach(function(date){
    date_list.push(date.date_of_order);
  });

  pickers.forEach(function(picker, index){
    order_list.push({
                    name: picker.picker,
                    data: []
                    });
    date_list.forEach(function(d){
      if (orders[order_index].picker == picker.picker && orders[order_index].date_of_order == d){
        order_list[index].data.push(orders[order_index].counts);
        order_index++;
      } else {
        order_list[index].data.push(0);
      }
    })
  });

  Highcharts.chart('graph_order_summary', {
    chart: {
        type: 'column'
    },
    title: {
        text: 'Order Summary'
    },
    xAxis: {
        title:{
          text: 'Date of Order'
        },
        categories: date_list,
        crosshair: true
    },
    yAxis: {
        min: 0,
        title: {
            text: 'Order'
        }
    },
    tooltip: {
        headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
        pointFormat: '<tr><td style="color:{series.color};padding:0">{series.name}: </td>' +
            '<td style="padding:0"><b>{point.y}</b></td></tr>',
        footerFormat: '</table>',
        shared: true,
        useHTML: true
    },
    plotOptions: {
        column: {
            pointPadding: 0.2,
            borderWidth: 0
        }
    },
    series: order_list
  });
}