<?php
// File to connect to server is added here
include 'serverConnector.php';

?>
<!--DOCTYPE html-->
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title></title>
  </head>
  <body>


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


            <?php
            $serverConn = new mysqli($serverName,$username,$password,$database);

            // We'll then create the table and add some test data for the program to work
            $tableCreate = $serverConn->query("CREATE TABLE IF NOT EXISTS institutions(id INT NOT NULL PRIMARY KEY AUTO_INCREMENT, uniName VARCHAR(255), uniDatabaseID VARCHAR(255), uniInit VARCHAR(255), uniURL VARCHAR(255), uniAdmin VARCHAR(255) )");

            if ($tableCreate) {

              //  We then check if test data exists in the mysql_list_tables
              $testId = "Test Uni";
              $testData = "SELECT uniName FROM institutions WHERE uniName='Test Uni'";

              $testQuery = mysqli_query($serverConn, $testData);

                if (mysqli_num_rows($testQuery) > 0) {
                  // If the test data already exists, do nothing else in this script
                }
                else{
                  $insertData = "INSERT INTO institutions(uniName,uniDatabaseID, uniInit,uniURL, uniAdmin) VALUES ('Test Uni','testuniID','TEST','https://www.test.test','test@test.test')";

                  $insQue = mysqli_query($serverConn, $insertData);

                  if ($insQue) {
                    // If the insertion is successful, simply do nothing and continue with process
                  }
                  else{
                    ?>
                    <script type="text/javascript">
                      alert("Test Data failed to insert");
                    </script>

                    <?php

                    header("Location: ../index.html");
                  }
                }
              }


            else{
              header("Location: ../index.html?FirstTimeTableCreationFailed");
            }



          }

          elseif (!$mainDbConn) {
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


                    // We'll then create the table and add some test data for the program to work
                    $tableCreate = $serverConn->query("CREATE TABLE IF NOT EXISTS institutions(id INT NOT NULL PRIMARY KEY AUTO_INCREMENT, uniName VARCHAR(255), uniDatabaseID VARCHAR(255), uniInit VARCHAR(255), uniURL VARCHAR(255), uniAdmin VARCHAR(255) )");

                    if ($tableCreate) {

                      $insertData = "INSERT INTO institutions(uniName,uniDatabaseID, uniInit,uniURL, uniAdmin) VALUES ('Test Uni','testuniID','TEST','https://www.test.test','test@test.test')";
                    }
                    else{
                      header("Location: ../index.html?FirstTimeTableCreationFailed");
                    }


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

     ?>
  </body>
</html>
