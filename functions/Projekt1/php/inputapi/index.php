<?php include "../init.php" ?>
<?php
// Berätta år browsern att vi tänker skicka JSON-data
header("Content-Type: application/json");

// Vi plockar ut variablerna från URLen och sparar i $request_vars
parse_str($_SERVER['QUERY_STRING'], $request_vars); // ==> ARRAY

// vi plockar ut data från request-bodyn 
$request_json = file_get_contents('php://input');
$request_body = json_decode($request_json); // ==> OBJEKT

function getData($conn, $sql, $key)
{
    // Skapa en while loop för att hämta varje rad!
    if ($result = $conn->query($sql)) {
        while ($row = $result->fetch_assoc()) {
            $hash = hash("sha256", $key);
            if ($hash == $row['api_key']) {
                return $row;
            }
        }
    }
    return false;
}

$key = $request_body->api_key;

$conn = create_conn();
$sql = "SELECT * FROM CMS_users";
$data = getData($conn, $sql, $key);
$response = new stdClass;
$response->status = 400;

// odatera.
// instalera.
if ($data) {
    $api_key = $key;
    $username = $request_body->username;
    $widgets = json_encode($request_body->widgets);
    $id = null;
    $statement = $conn->prepare("UPDATE CMS_users SET widgets = ? WHERE api_key = ?");
    $statement->bind_param("ss", $widgets, $api_key);
    // UPDATE `CMS_users` SET `widgets` = '22' WHERE `api_key` = 'b2a75f9ffbbc6200d72f53437048db5afce2cd3615b1bb07abe87ca7ac58e91f'
    if ($statement->execute()) {
        $response->status = 200;
        $response->widgets = json_decode($widgets);
        $response->info = "UPDATED";
    }
} else {
    $api_key = implode('-', str_split(substr(strtolower(md5(microtime().rand(1000, 9999))), 0, 30), 6));
    $api_hash = hash("sha256", $api_key);
    //$api_key = $data['api_key'];
    $username = $request_body->username;
    $widgets = json_encode($request_body->widgets);
    $id = null;
    $statement = $conn->prepare("INSERT INTO CMS_users (id, api_key, username, widgets) VALUES (?,?,?,?)");
    $statement->bind_param("isss", $id, $api_hash, $username, $widgets);
    if ($statement->execute()) {
        $response->status = 201;
        $response->widgets = json_decode($widgets);
        $response->api_key = $api_key;
        $response->info = "CREATED";
    }
}

$conn->close();
http_response_code($response->status);
print(json_encode($response));

?>