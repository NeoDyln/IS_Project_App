<?php
$serverName = "localhost";
$username = "root";
$password = "";

// First we connect to the server
$serverConn = new mysqli($serverName,$username,$password);

// Perform a test connection to the server
if ($serverConn->connect_error) {
  //If server is unreachable, return error
  die("Server Connection failed: ". $serverConn->connect_error);
  close();
  header(location: "../index.html?ServerConnFail");
}

?>
