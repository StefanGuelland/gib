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
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.16/css/dataTables.bootstrap4.min.css">

    <!-- Custom styles for this template -->
    <link href="css/dashboard.css" rel="stylesheet">
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

                    $stmt = $pdo->prepare("SELECT company.id as cid, career_site.website as career, timestamp, company.name, company.website
                        FROM career_site
                        LEFT JOIN company
                        ON career_site.company_id = company.id
                        WHERE company.history_id = 1
                        ORDER BY company.id
                        ");
                    $stmt->execute();

                    $careerData = $stmt->fetchAll();
                    ?>


          <h2>Career Sites</h2>
          <div class="table-responsive">
            <table id="careersites" class="table table-striped">
              <thead>
                <tr>
                    <th>Id</th>
                  <th>Name</th>
                  <th>Home URL</th>
                  <th>Career URLs</th>
                  <th>Timestamp</th>
                </tr>
              </thead>
              <tbody>
       <?php
       foreach($careerData as $careerRow){
       ?>
        <tr>
                    <td><?php echo $careerRow['cid'];  ?></td>
                  <td><?php echo $careerRow['name'];  ?></td>
                  <td><?php echo $careerRow['website'];  ?></td>
                  <td><?php echo $careerRow['career'];  ?></td>
                  <td><?php echo $careerRow['timestamp'];  ?></td>
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
    <script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.16/js/dataTables.bootstrap4.min.js"></script>
      <script type="text/javascript">
        $(document).ready(function() {
            $('#careersites').DataTable({
                 "pageLength": 50
            });
            $('#careersites').show();
        } );
    </script>
  </body>
</html>