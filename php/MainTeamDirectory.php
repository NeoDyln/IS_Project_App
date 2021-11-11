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
        // First we connect to the server
        $serverConn = new mysqli($serverName,$username,$password);

        // Perform a test connection to the server
        if ($serverConn->connect_error) {
          //If server is unreachable, return error
          die("Server Connection failed: ". $serverConn->connect_error);
        }
        else {

          // If server is reachable, notify success...
        ?>
          <script> alert( "Connected to Server. \n  Trying to reach database ...") </script>

        <?php

          // Now we select the specific database for the institution listings
          $datab = "CREATE DATABASE IF NOT EXISTS interappconn";
          $mainDbConn = $serverConn->query($datab);

          //We then try and query where it's there
          if ($mainDbConn) {
            $database = "interappconn";
            $mainDbConn = new mysqli($serverName,$username,$password, $database)
            // If successful...
            ?>
              <script>alert("Connected to database successfully")</script>

            <?php
            $serverConn = new mysqli($serverName,$username,$password,$database);



          }

          elseif (!mainDbConn) {
                // If database connection is unsuccessful, it means it does not exist so we create it
                ?>
                  <script>alert("Database connection failed. \n Creating Database ... ")</script>

                <?php
                $databaseCreQue = $serverConn->query("CREATE DATABASE interappconn");
                // We then query whether creation was successful
                if ($databaseCreQue) {
                    // If successful, we set that as the default server link
                  ?>
                    <script>alert("Created successfully");</script>
                    <?php
                    $database = "interappconn";
                    $serverConn = $serverConn = new mysqli($serverName,$username,$password,$database);
                    $_SESSION['serverConn'] = $serverConn;
                    header("Location: ../index.html?nfvnsfvn");

                }
                elseif (!databaseCreQue) {
                  ?>
                    <script type="text/javascript">
                      alert("Database creation failed...This isn't supposed to happen at all...Admin needs to recheck");
                    </script>
                  <?php
                  session_destroy();
                  header("Location: ../index.html/nvffnn");
                }

            }
        }
     ?>
  </body>
</html>
