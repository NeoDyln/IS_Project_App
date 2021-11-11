<?php

if(!isset($_SESSION)) {
  header("Location: ../index.html?WronglyAccessedFile");
}
else{

    $serverName = "localhost";
    $username = "root";
    $password = "";
    $newDb = strval($_SESSION['NewDbID']);
    $uniName =  strval($_SESSION['uniName']);
    $uniAdmin =  strval($_SESSION['uniAdmin']);



    // After collectind the new institution's database ID from the previous databases, we create a  database with that id as the db name

      // First we connect to the server
      $newDbConn = new mysqli($serverName,$username,$password);

      if ($newDbConn == TRUE){
        // If server connection is successful, we check if the database exists...Naturally, it's not supposed to exist but to be safe, we check anyway
      //   $newDbQuery = new mysqli($serverName,$username,$password, $newDb);
      //
      //
      //   if ($newDbQuery) {
      //     mysqli_close($newDbConn);
      //     // This check is supposed to be false
      //     // If the database already exists, we notify of a breech because this should be registration alone
      //     ?>
      //     <script type="text/javascript">
      //       alert("Possible data breach....Database already exists during first time creation..Check on dates of database \n creation from hosting service's database management page for database <?php echo $database; ?>");
      //       alert("Head back to login. This organization is already registered");
      //     </script>
      //
      //     <?php
      //     session_destroy();
      //     mysqli_close($newDbQuery);
      //     header("Location: ../index.html?DatabaseAlreadyExistsEch");
      //   }
      //   elseif (!$newDbQuery) {
          // Here, we confirmed the database should not exist hence we now create the database
          $dbCreate = $newDbConn->query("CREATE DATABASE $newDb");


          // We then execute it and query if successfully done

          if ($dbCreate){
            // Here, the database is successfully created.
            //  We then link it up with the mai server function as Below

            $mainDbConn = new mysqli($serverName, $username, $password, $newDb);
            // We now pass in the administrator data by making a table for them
            // We first check if the table for admins EXISTS
            $adminTable = "SELECT * FROM admins";

            $admiQuery = $mainDbConn->query($adminTable);

            if ($admiQuery->num_rows > 0) {
              // IF the connection is again true, then there must be a data breach somewhere
              ?>
              <script type="text/javascript">
                alert("Possible data breach for sure....Database table already exists during first time creation..Check on dates of database \n creation from hosting service's database management page for database <?php echo $database; ?>");
                alert("This organization/ team is registered. Returning to main page ... ");
              </script>

              <?php
              session_destroy();

              mysqli_close($mainDbConn);
              header("Location: ../index.html?DatabaseTableExistsAlready");

            }

            elseif ($admiQuery->num_rows == 0) {
              // Here we comfortably can be sure there was no breach of the system files thus we create our table
              $tableQuery =  $mainDbConn->query("CREATE TABLE IF NOT EXISTS admins (id INT NOT NULL PRIMARY KEY AUTO_INCREMENT, uniName VARCHAR(255), uniAdmin VARCHAR(255))");

              // Query for table creation

              if ($tableQuery == TRUE) {
                // We pass in the uni name and administrator
                $insertStmt = "INSERT INTO admins (uniName, uniAdmin) VALUES ('$uniName', '$uniAdmin')";
                $InsertQuery = $mainDbConn->query($insertStmt);

                // We then query if data was successfully entered
                if ($InsertQuery == TRUE) {
                  ?>
                  <script type="text/javascript">
                    alert("Institution/ Team Created successfully. Please go and register using the Get Started Button");
                  </script>

                  <?php

                  session_destroy();
                  header("Location: ../index.html?InstCreatedSuccess");
                }
                elseif ($InsertQuery == FALSE) {
                    ?>
                    <script type="text/javascript">
                      alert("Well this is unexpected. Data entry into institution table unsuccessful. We are working to resolve this soon");
                    </script>
                    <?php
                    session_destroy();
                    header("Location: ../index.html?InstCreationFailed");
                }


              }
              elseif (!$tableQuery) {
                ?>
                  <script type="text/javascript">
                    alert("Creation of administrator's table unsuccessful. Administrators will be added later. Proceed to register on the GET STARTED page by clicking on the relevant button after this popup");
                  </script>
                <?php
                session_destroy();
                header("Location: ../index.html?ErrorCreatingAdminTable");

              }



            }

          }

          elseif (!$dbCreate){
            // Here, the database creation attemp failed so we delete everything and have the user repeat the process

                      $newDbConn = new mysqli($serverName, $username, $password, "interappconn");

                      $deleteRecord = "DROP * from institutions where uniDatabaseID = $database";

                      $newDbConn->query($deleteRecord);
            ?>
              <script type="text/javascript">
                alert("An unexpected error occured during registration -> section: Org Database creation. Please try registering again");
              </script>
            <?php


            session_destroy();
            mysqli_close($newDbConn);
            header("Location: ../index.html?DatabaseCreationError");
          }

        // }


      }

      elseif ($newDbConn->connect_error) {
        //If server is unreachable, return error
        die("Server Connection failed: ". $newDbConn->connect_error);
        session_destroy();
        header("Location: ../index.html?newDbConnectError");
      }



  }
?>
