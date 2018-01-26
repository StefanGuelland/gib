<?php Header("Content-Type: text/html; charset=iso-8859-1");?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="../../favicon.ico">

    <title>Dashboard Template for Bootstrap</title>

    <!-- Bootstrap core CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/css/bootstrap.min.css" integrity="sha384-rwoIResjU2yc3z8GV/NPeZWAv56rSmLldC3R/AZzGRnGxQQKnKkoFVhFQhNUwEyJ" crossorigin="anonymous">

    <!-- Custom styles for this template -->
    <link href="css/dashboard.css" rel="stylesheet">
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
      google.charts.load('current', {'packages':['corechart']});
      google.charts.setOnLoadCallback(drawChart);

      function drawChart() {

        var data = google.visualization.arrayToDataTable([
          ['Career', 'Number of Pages'],
          ['Careerpage in Domain',     11],
          ['No Careerpage in Domain',      2]
        ]);

        var options = {
          title: 'Careerpages',
          colors: ['#738fa0','#254356']
        };

        var chart = new google.visualization.PieChart(document.getElementById('piechart'));
        chart.draw(data, options);


        var data2 = google.visualization.arrayToDataTable([
          ['Pages', 'Number of Domains'],
          ['Analyzed', 42],
          ['Not Analyzed', 2002]
        ]);

        var options2 = {
          title: 'Analyzed Data',
          colors: ['#738fa0','#254356']
        };

        var chart2 = new google.visualization.PieChart(document.getElementById('piechart2'));


        chart2.draw(data2, options2);
      }
    </script>
  </head>

  <body>
    <nav class="navbar navbar-toggleable-md navbar-inverse fixed-top bg-inverse">
      <a class="navbar-brand" href="#">Dashboard</a>
    </nav>

    <div class="container-fluid">
      <div class="row">
        <nav class="col-sm-3 col-md-2 hidden-xs-down bg-faded sidebar">
          <ul class="nav nav-pills flex-column">
            <li class="nav-item">
              <a class="nav-link" href="index.php">Overview <span class="sr-only">(current)</span></a>
            </li>
            <li class="nav-item">
              <a class="nav-link active" href="#">Reports</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="companydbdump.php">Company DB Dump</a>
            </li>
          </ul>


        </nav>

        <main class="col-sm-9 offset-sm-3 col-md-10 offset-md-2 pt-3">
          <h1>Reports</h1>
                 <?php
$pdo = new PDO('mysql:host=db;dbname=firmendb;charset=latin1', 'springuser', 'ThePassword');

$stmt = $pdo->prepare("SELECT name, id, website, postal_code FROM company WHERE history_id = 1 LIMIT 50");
$stmt->execute();

$companyData = $stmt->fetchAll();
 ?>


          <h2>Section title</h2>
          <div class="table-responsive">
            <table class="table table-striped">
              <thead>
                <tr>
                  <th>ID</th>
                  <th>Unternehmen</th>
                  <th>URL</th>
                  <th>Postal Code</th>
                </tr>
              </thead>
              <tbody>
       <?php
       foreach($companyData as $companyRow){
       ?>
        <tr>
                  <td><?php echo $companyRow['id'];  ?></td>
                  <td><?php echo $companyRow['name'];  ?></td>
                  <td><?php echo $companyRow['website'];  ?></td>
                  <td><?php echo $companyRow['postal_code'];  ?></td>
                </tr>
       <?php

       }


       ?>
              </tbody>
            </table>
          </div>
        </main>
      </div>
    </div>

    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="https://code.jquery.com/jquery-3.1.1.slim.min.js" integrity="sha384-A7FZj7v+d/sdmMqp/nOQwliLvUsJfDHW+k9Omg/a/EheAdgtzNs3hpfag6Ed950n" crossorigin="anonymous"></script>
    <script>window.jQuery || document.write('<script src="../../assets/js/vendor/jquery.min.js"><\/script>')</script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/tether/1.4.0/js/tether.min.js" integrity="sha384-DztdAPBWPRXSA/3eYEEUWrWCy7G5KFbe8fFjk5JAIxUYHKkDx6Qin1DkWx51bBrb" crossorigin="anonymous"></script>
    <script src="../../dist/js/bootstrap.min.js"></script>
    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <script src="../../assets/js/ie10-viewport-bug-workaround.js"></script>
  </body>
</html>