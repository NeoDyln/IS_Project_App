<?php
  session_start();
  include 'MainDirConnect.php';


//We collect Data from forms first

  //  Protect against injection with the below statement
  // mysqli_real_escape_string($database_Connection, $The_POST_Value_From_Form)
  $uniName = mysqli_real_escape_string($serverConn, stripcslashes($_POST['uniName']));
  $uniInit = mysqli_real_escape_string($serverConn, stripcslashes($_POST['uniInitials']));
  $uniWebsite = mysqli_real_escape_string($serverConn, stripcslashes($_POST['uniURL']));
  $uniAdmins = array( mysqli_real_escape_string($serverConn, stripcslashes($_POST['uniAdmin'])));
  // $uniDB = RANDOM ID

// Two requests...Creation of Db and DB Select


 //This first checks if the table exists and if it doesn't, a new table is made

  $tableQuery =  $serverConn->query("CREATE TABLE IF NOT EXISTS institutions(id INT AUTO_INCREMENT,uniName VARCHAR,uniDatabaseID VARCHAR,uniInit VARCHAR )");

  //We then query whether uni data exists in the table

  $checkValues = $serverConn->query("SELECT * FROM institutions");

    if ($checkValues == TRUE) {
      // Institutions exists
      // We confirm if data about the current typed
      $uniList = $serverConn->query("SELECT $uniName FROM institutions");

      if ($uniList == TRUE) {
        header("Location: ../index.php?UniExists");
      }
      else {

        $InsertStmt = $serverConn->prepare("Insert into institutions(uniName,uniTableID,adminUni) values(?,?,?)");

        $InsertStmt->bind_param("is",$uniName,$uniDB,$uniAdmins,$uniWebsite);

        $InsertStmt->execute();

        //At this point, a new entry has been made into the main table and we need to create a matching new database
        //In order to do so, we need to carry over the new database name/ ID to the new db creator as Below


        $_SESSION['NewDbID'] = $uniDB;

        //We then go over to the new file to connect it to our server
        include "NewDBConnect.php";
        include "CreateUniDB.php";



      }


    }
    elseif ($checkValues == FALSE) {
      // Institution does not exist
      // What we want to do is create a table for that institution and list it as a record Here

      $InsertStmt = $serverConn->prepare("Insert into institutions(uniName,uniTableID,adminUni,uniWebsite) values(?,?,?)");

      //To generate the unique ID for a database, we first create the random item
      $randomBytes = random_bytes(20);
      // As it is in byte form, we convert it to hexadecimal
      $randomHex = bin2hex($randomBytes);
      //We then extract the number of characters we want from the hex value and assign it to our randomId
      $uniDB = substr($randomHex, 0, 20);

      //We would want to make sure that the created ID is not already in the table as it acts as a unique reference to the database of an Institutions

      $ConfirmDbIdUnique = "SELECT uniTableID FROM institutions WHERE uniTableID == $uniDB";

      //If it exists, we repeat the random creator and generate a new ID and check again as below
      // When the below becomes false, then the ID is added to the database
      while ($ConfirmDbIdUnique == TRUE) {
        $randomBytes = random_bytes(20);
        $randomHex = bin2hex($randomBytes);
        $uniDB = substr($randomHex, 0, 20);
      }


      //We then bind the data to the prepared insert statement

      $InsertStmt->bind_param("is",$uniName,$uniDB,$uniAdmins,$uniWebsite);

      $InsertStmt->execute();


    }




//Db Select



 ?>
