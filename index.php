<?php 
  //database connection
  $conn = mysqli_connect("localhost", "root", "", "games");

  $sql = "SELECT play, count(*) as number FROM players GROUP BY play";
  $result = mysqli_query($conn, $sql);
?>


<html>
  <head>
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
      google.charts.load('current', {'packages':['corechart']});
      google.charts.setOnLoadCallback(drawChart);

      function drawChart() {

        var data = google.visualization.arrayToDataTable([
          ['Play', 'Number'],
          <?php
          while($row = mysqli_fetch_array($result)){
            echo "['".$row["play"]."', ".$row["number"]."],";
          }
          ?>
        ]);

        var options = {
          title: 'Players Statistics',
          is3D: true,
        };

        var chart = new google.visualization.PieChart(document.getElementById('piechart'));

        chart.draw(data, options);
      }
    </script>
  </head>
  <body>
    <div id="piechart" style="width: 900px; height: 500px;"></div>
  </body>
</html>
