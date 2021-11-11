<?php
  include 'MainDirConnect.php';
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Checking Organizations...</title>
  </head>
  <body>
    <?php

        // Two requests...Creation of Db and DB Select


         //This first checks if the table exists and if it doesn't, a new table is made

          $tableQuery =  $serverConn->query("SELECT * FROM institutions");

          if ($tableQuery == TRUE) {
            $uniLister = $serverConn->query("SELECT uniInit,uniName FROM institutions");

            $row = mysqli_fetch_array($uniLister);

            // We then pull this to the form page. Check sample line 67 in auth.php


          }
          else {
        ?>
        <script>alert("Database Tables do not exist.\nNo Organizations registered at the moment. \nPlease ask your Organization Admin to register")</script>

        <?php


      }




     ?>

  </body>
</html>


<?
