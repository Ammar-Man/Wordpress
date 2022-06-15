<?php
$USER = test_input("ammar2");  // 2 här spars namn till storge
    $PASS = test_input("password");
   // $PASS = hash("sha256", $PASS);
    $conn = create_conn();
    $sql = "SELECT * FROM CMS_users WHERE username = ? AND api_key = ? limit 1";

    //$sql = "SELECT * FROM users WHERE username = '".$USER."' AND password='".$PASS. "' limit 1";
    $stmt = $conn->prepare($sql); // beskyte mot insjektion 

    $stmt->bind_param("ss", $USER, $PASS); //tar bort dårlig hackigs code 
    $stmt->execute(); // Kör sql kommandot - returnerar boolean (true/false)

    $result = $stmt->get_result(); // returnerar false eller mysqli_result objekt
    $row = $result->fetch_assoc(); //Ta ut datan från  mysqli_result objektet till en assArr
    if ($row == true) {

        $_SESSION["loggit"] = "loggitin";
        $_SESSION["id"]     = $row['id'];
        $_SESSION["api_key"]     = $row['api_key'];
        $_SESSION["username"]        = $row['username'];
        $_SESSION["widgets"]      = $row['widgets'];
    
    }  

    

        ?>