
<?php include "../init.php" ?>




<?php
// Berätta år browsern att vi tänker skicka JSON-data
header("Content-Type: application/json");
header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE");

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

if (!$key)
    $key = get_request_header("X-API-KEY");

$conn = create_conn();
$sql_user = "SELECT * FROM CMS_users";
$data = getData($conn, $sql_user, $key);

$response = new stdClass;
$response->status = 400;

// instalera.
if ($data) {
    $user_id = $data['id'];

    $title = $request_body->title;
    $category = $request_body->category_id;
    $done = $request_body->done;
    $date = $request_body->date;

    // Lägg till i todo lista
    if ($_SERVER["REQUEST_METHOD"] === "POST") {
        // INSERT INTO `CMS_todo` (`id`, `user_id`, `category_id`, `title`, `done`, `due_date`, `created_at`, `updated_at`, `sort_order`) VALUES (NULL, '1', '1', 'Hello World123', '0', '2022-05-12', current_timestamp(), '0000-00-00 00:00:00.000000', '0');
        $statement = $conn->prepare("INSERT INTO CMS_todo (user_id, category_id, title, done, due_date, sort_order) VALUES (?,?,?,?,?,?)");
        $order = 0;
        $statement->bind_param("iisisi", $user_id, $category, $title, $done, $date, $order);
        if ($statement->execute()) {
            $response->status = 201;
            $response->info = "INSERT";
        }
    }

    // Hämta todo lista
    else if ($_SERVER["REQUEST_METHOD"] === "GET") {
        // SELECT * FROM `CMS_todo` WHERE `user_id` = 1 AND `category_id` = 2
        /*$statement = $conn->prepare("SELECT * FROM CMS_todo WHERE user_id = ? AND category_id = ?");
        $statement->bind_param("ii", $user_id, $category);
        if ($result = $statement->execute()) {
            $response->status = 200;
            $response->info = "GET";
            $response->$result;
        }*/
        $response->status = 200;
        $response->data = $request_body; //$get_request_header("X-API-KEY");
    }

    // Updatera Done
    else if ($_SERVER["REQUEST_METHOD"] === "PUT") {
        
    }

    // Ta bort inlägg från todo
    else if ($_SERVER["REQUEST_METHOD"] === "DELETE") {
        
    }
} else {
    $response->info = "API_KEY invalid";
}

$conn->close();
http_response_code($response->status);
print(json_encode($response));

?>
