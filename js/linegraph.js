$(document).ready(function(){
    $.ajax({
      url : "http://localhost/website/followersdata.php",
      type : "GET",
      success : function(data){
        console.log(data);
  
        var date = [];
        var temp_arr = [];
        var hum_arr = [];        
  
        for(var i in data) {
            if(i%2 == 0){
            date.push(data[i].time);
            temp_arr.push(data[i].temperature);
            hum_arr.push(data[i].humidity);
            }
        }
  
        var chartdata = {
          labels: date,
          datasets: [
            {
              label: "temperature",
              fill: false,
              lineTension: 0.1,
              backgroundColor: "rgba(59, 89, 152, 0.75)",
              borderColor: "rgba(59, 89, 152, 1)",
              pointHoverBackgroundColor: "rgba(59, 89, 152, 1)",
              pointHoverBorderColor: "rgba(59, 89, 152, 1)",
              data: temp_arr
            },
            {
              label: "humidity",
              fill: false,
              lineTension: 0.1,
              backgroundColor: "rgba(29, 202, 255, 0.75)",
              borderColor: "rgba(29, 202, 255, 1)",
              pointHoverBackgroundColor: "rgba(29, 202, 255, 1)",
              pointHoverBorderColor: "rgba(29, 202, 255, 1)",
              data: hum_arr
            }            
          ]
        };
  
        var ctx = $("#mycanvas");
  
        var LineGraph = new Chart(ctx, {
          type: 'line',
          data: chartdata
        });
      },
      error : function(data) {
  
      }
    });
  });