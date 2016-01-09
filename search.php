<?php
  include("connect.php");
  include('lock.php'); 
  if (isset($_GET["submit"])){
    $match_number = $_GET["match_number"];
    $team_number = $_GET["team_number"];

    if (!empty($match_number)&&!empty($team_number)){
      $q = "SELECT * FROM data WHERE match_num = {$match_number} AND team_num = '{$team_number}';";
    }elseif (!empty($match_number)){
      $q = "SELECT * FROM data WHERE match_num = {$match_number};";
    }elseif(!empty($team_number)){
      $q = "SELECT * FROM data WHERE team_num = '{$team_number}';";
    }else{
      $q = "SELECT * FROM data;";
    }

    $result = mysqli_query($conn, $q);
  }
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>Search</title>

    <!-- Bootstrap -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    
    <link rel="icon" href="1.ico" type="image/x-icon" sizes="256x256">

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

    <style type="text/css">
      input{
        margin-bottom: 10px;
      }
      li{
        margin-left: 5px;
        margin-right: 10px;
      }
      h1{
        margin-top: 100px;
      }
    </style>
  </head>
  <body>
    <nav class="navbar navbar-inverse navbar-fixed-top">
      <div class="navbar-header">
        <a href="index.php" class="navbar-brand">211 Scouting Systam</a>
      </div>
      <div class="navbar-collapse collapse">
        <ul class="nav navbar-nav">
          <li>
            <a href="index.php">Home</a>
          </li>
          <li class="active">
            <a href="search.php">Search</a>
          </li>
          
        </ul>

        <ul class="nav navbar-nav navbar-right">
          <li>
            <a>Loged in as: <?php echo $login_session;?></a>
          </li>
          <li>
            <a href="logout.php">Log Out</a>
          </li>
        </ul>

      </div>
    </nav>

    <div class="container">
      <h1>Search</h1>
      <div class="row">
        <div class="col-md-2">
          <form method="get"> 
            Match Number: <input type="text" name="match_number" value=""><br />
            Team Number: <input type="text" name="team_number" value=""><br />
            <hr>
            <input type="submit" name="submit" Value="Search" class="btn btn-lg btn-success">
          </form>
        </div>
      </div>

      <?php
      if(isset($result)){
        if($result){
          echo "<hr>";
          echo "<table class='table table-striped'>
          <tr> <th>ID</th> <th>Match Number</th> <th>Team Number</th> <th>Lift</th> <th>Lifted</th> <th>Auto</th> <th>Drive</th> </tr>";
          while($row = mysqli_fetch_assoc($result)){
            echo "<tr>" .
             "<td>" . $row["id"]. "</td>" . 
             "<td>" . $row["match_num"]. "</td>" . 
             "<td>" . $row["team_num"]. "</td>" . 
             "<td>" . $row["lift"]. "</td>" . 
             "<td>" . $row["lifted"]. "</td>" . 
             "<td>" . $row["auto"]. "</td>" . 
             "<td>" . $row["drive"]. "</td>" . 
             "</tr>";
          }
          echo" </table>";
        }
      }
      ?>

    </div>
    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="js/bootstrap.min.js"></script>
  </body>
</html>

<?php include("disconnect.php") ?>