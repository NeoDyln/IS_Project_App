<?php

$serverName = "localhost";
$username = "root";
$password = "";

?>
<!--DOCTYPE html-->
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title></title>
  </head>
  <body>
    <?php

        $serverConn = new mysqli($serverName,$username,$password);

        if ($serverConn->connect_error) {
          die("Server Connection failed: ". $serverConn->connect_error);
        }
        else {
        ?>
          <script> alert( "Connected to Server. \n  Trying to reach database ...") </script>

        <?php
          $database = "interappconn";
          $mainDbConn = new mysqli($serverName,$username,$password, $database);

          if ($mainDbConn == TRUE) {
            ?>
              <script>alert("Connected to database successfully")</script>

            <?php
            $serverConn = new mysqli($serverName,$username,$password,$database);

          }

          else {
            ?>
              <script>alert("Database connection failed. \n Creating Database ... ")</script>

            <?php
            $databaseCreQue = $serverConn->query("CREATE DATABASE interappconn");

            if ($databaseCreQue == TRUE) {
              ?>
                <script>alert("Created successfully");</script>
                <?php
                $database = "interappconn";
                $serverConn = $serverConn = new mysqli($serverName,$username,$password,$database);
            }
            else {
              ?>
                <script type="text/javascript">
                  alert("Database creation failed...Web Admin needs to recheck");
                </script>
              <?php
              session_destroy();
              header("Location: ../index.php");
            }

          }
        }
     ?>
  </body>
</html>
