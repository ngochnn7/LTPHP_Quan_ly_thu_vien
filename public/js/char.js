$(document).ready(function (){
  $.ajax({
    url: "ajax/laysoluongsach",
      method: 'POST', 
      success:function(data) {
        var dulieu = JSON.parse(data);  
        console.log(dulieu);     
        new Morris.Bar({
          // ID of the element in which to draw the chart.
          element: 'myfirstchart',
          // Chart data records -- each entry in this array corresponds to a point on
          // the chart.
          data: dulieu,
          // The name of the data record attribute that contains x-values.
          xkey: 'TenCN',
          // A list of names of data record attributes that contain y-values.
          ykeys: ['SoLuong'],
          // Labels for the ykeys -- will be displayed when you hover over the
          // chart.
          labels: ['Số Lượng']
        });
      }     
  });  
});
