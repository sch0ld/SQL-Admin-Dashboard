<?php  
    if(isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on')   
         $CurrentURL = "https://";   
    else  
         $CurrentURL = "http://";   
    // Append the host(domain name, ip) to the URL.   
    $CurrentURL.= $_SERVER['HTTP_HOST'];   
    
    // Append the requested resource location to the URL   
    $CurrentURL.= $_SERVER['REQUEST_URI'];    
      

    // Starts a session
    session_start();


    // This needs to be FALSE for the LIVE VERSION
    $debug = false;


    // Sets basic connection variabled to easily be able to change databse IP and login
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbName = "database";


    // Connects to the database using the info assigned above
    $conn = new mysqli($servername, $username, $password, $dbName);

    // Makes sure the connection is established, if else, print the error_message
    if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
    }
    // If the debugmode is on, it prints the Successfully connected message
    if ($debug) {
        echo "Connected successfully";
    }


    

?>
