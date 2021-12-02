<?php
if(session_status() !== PHP_SESSION_ACTIVE) session_start();
if(session_status() === PHP_SESSION_NONE) session_start();
// First we include the server connector
require 'serverConnector.php';




  // First we need to make sure the page is properly accessed through the form submit button

  if (isset($_POST['registerTeam'])) {
    //We collect Data from forms first


    if (isset($_POST['uniName']) && isset($_POST['uniInit']) && isset($_POST['uniURL']) && isset($_POST['uniAdmin'])) {

    //  Protect against injection with the below statement
    // mysqli_real_escape_string($database_Connection, $The_POST_Value_From_Form)
    $uniName =  mysqli_real_escape_string($serverConn, stripcslashes($_POST['uniName']));
    $uniInit = mysqli_real_escape_string($serverConn, stripcslashes($_POST['uniInit']));
    $uniWebsite = mysqli_real_escape_string($serverConn, stripcslashes($_POST['uniURL']));
    $uniAdmin = mysqli_real_escape_string($serverConn, stripcslashes($_POST['uniAdmin']));
    // $uniDB = RANDOM ID

    // First we check if the Main database exists
    // I opted to create the connection statement then append the main db name on it then test with an if..else statement

    $serverConn = new mysqli($serverName, $username, $password, "interappconn");

    // Checking for database existence
      if($serverConn){
        // Database existence is true here
        //  We then check for the main table's existence
        // Since it shoould have been created at MainDatabaseCreator, we simply check whether the table has data



                 $checkValues = $serverConn->prepare("SELECT * FROM institutions");
                 $checkValues->execute();
                 $checkValues->store_result();

                   // IF data exists...
                 if ($checkValues->num_rows > 0 ) {
                     // Institutions exists
                     // We confirm if data about the current typed institution
                     $uniList = mysqli_query($serverConn , "SELECT uniName FROM institutions WHERE uniName = '.$uniName.' LIMIT 1 ");

                    $row = mysqli_fetch_array($uniList);


                     while ($row){
                       // Return an error that the team/ organization is registered
                       echo $row;
                       header("Location: ../index.html?UniExisvfdfts");

                     }


                         // Insert the new organization as a new record
                         // Since it's a new record

                         $InsertStmt = $serverConn->prepare("INSERT INTO institutions(uniName,uniInit,uniDatabaseID,uniAdmin,uniURL) VALUES(?,?,?,?,?)");

                         // Inorder to insert the uni ID , we need to create it first
                         //To generate the unique ID for a database, we first create the random item
                         // I opted for taking the uni name and removing the whitespaces then appending an integer to its end
                         // Below I have removed the whitespace
                         $uniNm = str_replace(' ', '', $uniName);
                         // I then generated an integer ranging between 0 and 99
                         $randomInt = rand(0,99);
                         // I then converted it to a string
                         $randStr = strval($randomInt);
                         // I then append or merge the uniName to the random integer
                         $uniDB =  strtolower($uniNm.$randStr);

                         //We would want to make sure that the created ID is not already in the table as it acts as a unique reference to the database of an Institutions

                         $ConfirmDbIdUnique = mysqli_query($serverConn, "SELECT uniDatabaseID FROM institutions WHERE uniDatabaseID = '.$uniDB.' LIMIT 1");

                         $confRes = mysqli_fetch_array($ConfirmDbIdUnique);

                         //If it exists, we repeat the random creator and generate a new ID and check again as below
                         // When the below becomes false, then the ID is added to the database
                         while ($confRes) {
                           // I again generated an integer ranging between 0 and 99
                           $randomInt = rand(0,99);
                           // I then converted it to a string
                           $randStr = strval($randomInt);
                           // I then append or merge the uniName to the random integer
                           $uniDB = strtolower($uniNm.$randStr);

                         }

                         $InsertStmt->bind_param("sssss",$uniName,$uniInit,$uniDB,$uniAdmins,$uniURL);

                         $InsertStmt->execute();

                         //At this point, a new entry has been made into the main table and we need to create a matching new database
                         //In order to do so, we need to carry over the new database name/ ID to the new db creator as Below


                         $_SESSION['NewDbID'] = $uniDB;
                         $_SESSION['uniName']= $uniName;
                         $_SESSION['uniAdmin'] = $uniAdmins;
                         mysqli_close($serverConn);

                         // We then go over to the new file to connect it to our server
                         include "NewTeamCreator.php";







                  }
                   // If completely no data exists...
                 elseif (mysqli_num_rows($checkValues) == 0) {
                       // Institution does not exist
                       // What we want to do is insert a record for that institution

                       $InsertStmt = $serverConn->prepare("Insert into institutions(uniName,uniInit,uniDatabaseID,uniAdmin,uniURL) values(?,?,?,?,?)");

                       // Inorder to insert the uni ID , we need to create it first
                       //To generate the unique ID for a database, we first create the random item

                       // I opted for taking the uni name and removing the whitespaces then appending an integer to its end
                       // Below I have removed the whitespace
                       $uniNm = str_replace(' ', '', $uniName);
                       // I then generated an integer ranging between 0 and 99
                       $randomInt = rand(0,99);
                       // I then converted it to a string
                       $randStr = strval($randomInt);
                       // I then append or merge the uniName to the random integer and make everything lowercase
                       $uniDB = strtolower($uniNm.$randStr);




                       //We then bind the data to the prepared insert statement

                       $InsertStmt->bind_param('sssss',$uniName,$uniInit,$uniDB,$uniAdmins,$uniWebsite);

                       $InsertStmt->execute();

                       $_SESSION['NewDbID'] = $uniDB;
                       $_SESSION['uniName']= $uniName;
                       $_SESSION['uniAdmin'] = $uniAdmins;
                       mysqli_close($serverConn);

                       echo "string";

                       include "NewTeamCreator.php";


                   }
                 else{
                   include 'MainDatabaseCreator.php';
                   close();
                   header(location: "../index.html?DatabasedidNotExistTryAgain");
                 }





      }

      else{
        // Here database does not exist so we create it
        // Since I have a file dedicated to running this, I'll call it Here

        include 'MainDatabaseCreator.php';

        // Afterwards, I will close active sessions and return the user to the create acc page for them to retry

        close();
        session_destroy();
        header("Location: ../getStarted.php");


      }
    }

  }

  else {
    echo "You did not follow the correct procedure. Redirecting you back to the home page...";
    session_destroy();
    header("Location: ../index.html");
  }









?>
