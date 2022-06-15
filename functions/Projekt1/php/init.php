<?php
session_start();

// Remove whitespaces, remove extra slashes, and convert to safe html characters
// USE FOR ALL USER INPUT
function test_input($data)
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

function getRequestUri() {
    $params = [];
    $parts = explode('/', $_SERVER['REQUEST_URI']);
    for ($i = 0; $i < count($parts) - 1; $i++) {
        $params[$parts[$i]] = $parts[$i + 1];
    }
    return $params;
}

function getRequest($object, $value, $default = null) {
    if (is_object($object) && property_exists($object, $value)) {
        return $object->$value;
    }
    return $default;
}

// Sets up connection to database - use $conn = create_conn(); to open connection and $conn->close();
function create_conn()
{
    // byt error reporting läge
    mysqli_report(MYSQLI_REPORT_ALL ^ MYSQLI_REPORT_INDEX);
    //Databaskonfiguration
    $servername = "localhost";
    $username = "almandaa";
    $password = "8PEsQB5PYL";
    $dbname = "almandaa";
    
    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);
    // Check connection

    // FIXA UTF8 encoding! 
    $conn->set_charset("utf8");

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    } else {
        return $conn;
    }
}
?>

