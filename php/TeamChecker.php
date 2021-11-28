<?php

if(session_status() !== PHP_SESSION_ACTIVE) session_start();
if(session_status() === PHP_SESSION_NONE) session_start();

if (isset($_SESSION)) {


  $daB = "interappconn";

  $serverConn = new mysqli($serverName,$username,$password,$daB);
        // Two requests...Creation of Db and DB Select
    if ($serverConn->connect_error){
        header("Location: ../index.html?serverConnError");
    }
    else{
      $quer = "SELECT uniInit,uniName FROM institutions";
      $uniLister = mysqli_query($serverConn, $quer);

      if ($uniLister) {
        if (mysqli_num_rows($uniLister) == 0) {
          header("Location: index.html?noRecords");
        }
        else{
          $row = $uniLister;


        }

      }
      else{
        header("Location: ../index.html?queryFail");
      }



      // else{
      //   $row = mysqli_fetch_array($uniLister);
      //   $_SESSION['row'] = $row;
      //   header("Location: ../index.html?noRecords");
      // }
    }


  }
  else{
    header("Location: ../index.html?NosessionExists");
  }


?>
