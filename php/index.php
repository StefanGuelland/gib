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
       <?php
           $availabale = getDomainAvailableData();
           $careersites = getCareerSiteFound();
       ?>
      google.charts.load('current', {'packages':['corechart']});
      google.charts.setOnLoadCallback(drawChart);

      function drawChart() {

        var dataUrl = google.visualization.arrayToDataTable([
          ['URL', 'Number of Pages'],
          ['URL',     <?php echo $availabale['notNullDomains'] ?>],
          ['No URL',      <?php echo $availabale['nullDomains'] ?>]
        ]);

        var optionsUrl = {
          title: 'Company DB URL Available?',
          colors: ['#738fa0','#254356']
        };

        var chartUrl = new google.visualization.PieChart(document.getElementById('piechart'));
        chartUrl.draw(dataUrl, optionsUrl);


        var dataCareer = google.visualization.arrayToDataTable([
          ['Careersites', 'Number of Pages'],
          ['Careersites found', <?php echo $careersites['hasCareer'] ?>],
          ['No careersites', <?php echo $careersites['noCareer'] ?>]
        ]);

        var optionsCareer = {
          title: 'Analyzed Data',
          colors: ['#738fa0','#254356']
        };

        var chartCareer = new google.visualization.PieChart(document.getElementById('piechart2'));


        chartCareer.draw(dataCareer, optionsCareer);
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
              <a class="nav-link active" href="#">Overview <span class="sr-only">(current)</span></a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="reports.php">Reports</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="companydbdump.php">Company DB Dump</a>
            </li>
          </ul>


        </nav>

        <main class="col-sm-9 offset-sm-3 col-md-10 offset-md-2 pt-3">
          <h1>Overview</h1>
            <?php getDomainAvailableData() ?>
          <section class="row text-center placeholders">
            <div class="col-6 col-sm-6 placeholder">
              <div id="piechart" style="height:400px"></div>
            </div>
            <div class="col-6 col-sm-6 placeholder">
              <div id="piechart2" style="height:400px"></div>
            </div>
          </section>
        </main>
      </div>
    </div>

    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="https://code.jquery.com/jquery-3.1.1.slim.min.js" integrity="sha384-A7FZj7v+d/sdmMqp/nOQwliLvUsJfDHW+k9Omg/a/EheAdgtzNs3hpfag6Ed950n" crossorigin="anonymous"></script>
    <script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.16/js/dataTables.bootstrap4.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/tether/1.4.0/js/tether.min.js" integrity="sha384-DztdAPBWPRXSA/3eYEEUWrWCy7G5KFbe8fFjk5JAIxUYHKkDx6Qin1DkWx51bBrb" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
  </body>
</html>

<?php

 function getDomainAvailableData(){

    $pdo = new PDO('mysql:host=db;dbname=firmendb;charset=latin1', 'springuser', 'ThePassword');
     $stmt = $pdo->prepare("SELECT count(id) FROM `company` WHERE website is null");
     $stmt->execute();
     $nullDomains = $stmt->fetch();
     $ret['nullDomains'] = $nullDomains[0];

     $stmt = $pdo->prepare("SELECT count(id) FROM `company` WHERE website is not null");
     $stmt->execute();
     $notNullDomains = $stmt->fetch();
     $ret['notNullDomains'] = $notNullDomains[0];

     return $ret;
 }

  function getCareerSiteFound(){
  $pdo = new PDO('mysql:host=db;dbname=firmendb;charset=latin1', 'springuser', 'ThePassword');
     $stmt = $pdo->prepare("SELECT COUNT( DISTINCT company_id) FROM career_site");
     $stmt->execute();
     $hasCareer = $stmt->fetch();
     $ret['hasCareer'] = $hasCareer[0];

     $stmt = $pdo->prepare("SELECT COUNT( DISTINCT company.id)
                            FROM company
                            where company.id not in ( Select company_id from career_site)
                            AND company.website is not null");
     $stmt->execute();
     $noCareer = $stmt->fetch();
     $ret['noCareer'] = $noCareer[0];

     return $ret;
 }


?>