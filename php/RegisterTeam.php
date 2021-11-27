<?php
  session_start();
// First we include the server connector
  include 'serverConnector.php';



  // First we need to make sure the page is properly accessed through the form submit button

  if (isset($_POST['registerTeam'])) {
    //We collect Data from forms first


    //  Protect against injection with the below statement
    // mysqli_real_escape_string($database_Connection, $The_POST_Value_From_Form)
    $uniName = mysqli_real_escape_string($serverConn, stripcslashes($_POST['uniName']));
    $uniInit = mysqli_real_escape_string($serverConn, stripcslashes($_POST['uniInit']));
    $uniWebsite = mysqli_real_escape_string($serverConn, stripcslashes($_POST['uniURL']));
    $uniAdmin = mysqli_real_escape_string($serverConn, stripcslashes($_POST['uniAdmin']));
    // $uniDB = RANDOM ID

  // Two requests...Creation of table and table Select

    $serverConn = new mysqli($serverName, $username, $password, "interappconn");
   //This first checks if the table exists and if it doesn't, a new table is made
    
    if($serverConn){
       $serverConn->query("CREATE TABLE IF NOT EXISTS institutions(id INT NOT NULL PRIMARY KEY AUTO_INCREMENT, uniName VARCHAR(255), uniDatabaseID VARCHAR(255), uniInit VARCHAR(255), uniURL VARCHAR(255), uniAdmin VARCHAR(255) )");




    // We then query whether uni data exists in the table

    $checkValues = $serverConn->query("SELECT * FROM institutions");
      // IF data exists...
    if ($checkValues->num_rows > 0 ) {
        // Institutions exists
        // We confirm if data about the current typed institution
        $uniList = $serverConn->query("SELECT COUNT(uniName) FROM institutions WHERE uniName == ".$_POST['uniName']);

        if ($uniList > 0){
          // Return an error that the team/ organization is registered
          header("Location: ../index.html?UniExists");
        }
        elseif ($uniList == 0) {

          // Insert the new organization as a new record
          // Since it's a new record

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
          // I then append or merge the uniName to the random integer
          $uniDB =  strtolower($uniNm.$randStr);

          //We would want to make sure that the created ID is not already in the table as it acts as a unique reference to the database of an Institutions

          $ConfirmDbIdUnique = "SELECT $uniDB FROM institutions WHERE uniTableID == ";
          $confRes = mysqli_query($serverConn, $ConfirmDbIdUnique);

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

      }




      // If completely no data exists...
    elseif ($checkValues->num_rows == 0) {
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

   



  } 
  else {
    echo "You did not follow the correct procedure. Redirecting you back to the home page...";
    session_destroy();
    header("Location: ../index.html");
  }









?>
