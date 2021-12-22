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
            $tableCreate = $serverConn->query("CREATE TABLE IF NOT EXISTS institutions(id INT NOT NULL PRIMARY KEY AUTO_INCREMENT, uniName VARCHAR(255) UNIQUE, uniInit VARCHAR(255), uniURL VARCHAR(255), uniAdmin VARCHAR(255) )");

            if ($tableCreate) {

              //  We then check if test data exists in the mysql_list_tables
              $testName = "Test Uni (Do not use)";
              $testData = $serverConn->prepare("SELECT uniName FROM institutions WHERE uniName= ?");
              $testData->bind_param('s', $testName);
              $testData->execute();

              $testQuery = $testData->get_result();




                if (mysqli_num_rows($testQuery) > 0) {
                  // If the test data already exists, do nothing else in this script
                }
                else{
                  $insertData = $serverConn->prepare("INSERT INTO institutions(uniName, uniInit,uniURL, uniAdmin) VALUES (?,?,?,?)");


                  $testInit = "TEST";
                  $testURL = "https://www.test.test";
                  $testAdmin = "test@test.test";

                  $insertData->bind_param("ssss", $testName,$testInit,$testURL, $testAdmin);
                  $insQue = $insertData->execute();

                  if ($insQue) {
                    //  If the test data has been inserted well, we create the assosciated database for the test datab


                    $testDatabase = mysqli_query($serverConn, "CREATE DATABASE IF NOT EXISTS $testInit ");

                    if(!$testDatabase){
                      header("Location: ../register.php?TestDBC1");;
                    }
                    else{

                    }
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
                    $tableCreate = $serverConn->query("CREATE TABLE IF NOT EXISTS institutions(id INT NOT NULL PRIMARY KEY AUTO_INCREMENT, uniName VARCHAR(255), uniInit VARCHAR(255), uniURL VARCHAR(255), uniAdmin VARCHAR(255) )");

                    if ($tableCreate) {

                      $insertData = $serverConn->prepare("INSERT INTO institutions(uniName, uniInit,uniURL, uniAdmin) VALUES (?,?,?,?)");

                      $testName = "Test Uni";
                      $testInit = 'TEST';
                      $testURL = 'https://www.test.test';
                      $testAdmin = 'test@test.test';

                      $insertData->bind_param("ssss", $testName,$testInit,$testURL, $testAdmin);
                      $insQue = $insertData->execute();

                      if ($insQue) {
                        //  If the test data has been inserted well, we create the assosciated database for the test datab


                        $testDatabase = mysqli_query($serverConn, "CREATE DATABASE IF NOT EXISTS $testInit");

                        if(!$testDatabase){
                          header("Location: ../register.php?TestDBC");;
                        }
                        else{

                        }
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
