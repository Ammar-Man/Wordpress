
<?php include "init.php" ?>
<?php
// Berätta år browsern att vi tänker skicka JSON-data
header("Content-Type: application/json");
header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE");

// Vi plockar ut variablerna från URLen och sparar i $request_vars
parse_str($_SERVER['QUERY_STRING'], $request_vars); // ==> ARRAY

// vi plockar ut data från request-bodyn 
$request_json = file_get_contents('php://input');
$request_body = json_decode($request_json); // ==> OBJEKT
$request_uri = getRequestUri();

if (empty($request_body)) {
    $request_body = null;
}

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

function fetchAndWrite($sql)
{
  $conn = create_conn();
  if ($result = $conn->query($sql)) {
    return  mysqli_fetch_all($result);
  } 
    return false;
}

$key = getRequest($request_body, "api_key");
if (!$key)
    $key = apache_request_headers()['X-API-Key'];

$conn = create_conn();
$sql_user = "SELECT * FROM CMS_users";
$data = getData($conn, $sql_user, $key);

$response = new stdClass;
$response->status = 400;

// instalera.
if ($data) {
    $user_id = $data['id'];

    // Lägg till i todo lista
    if ($_SERVER["REQUEST_METHOD"] === "POST") {

       // genom new Date().toISOString().split("T")[0]
        $title = $request_body->title;
        $category = $request_body->category_id;
        $done = $request_body->done;
        $date = $request_body->date;
        // INSERT INTO `CMS_todo` (`id`, `user_id`, `category_id`, `title`, `done`, `due_date`, `created_at`, `updated_at`, `sort_order`) VALUES (NULL, '1', '1', 'Hello World123', '0', '2022-05-12', current_timestamp(), '0000-00-00 00:00:00.000000', '0');
        $statement = $conn->prepare("INSERT INTO CMS_todo (user_id, category_id, title, done, due_date, sort_order) VALUES (?,?,?,?,?,?)");
        $order = 0;
        $statement->bind_param("iisisi", $user_id, $category, $title, $done, $date, $order);
        if ($statement->execute()) {
            $response->status = 201;
            $response->info = "INSERT";
            $response->category = $category;
            $response->title = $title ;
        }
    }

    // Hämta todo lista
    else if ($_SERVER["REQUEST_METHOD"] === "GET") {
        $category = end($request_uri);
        $bobsql = "SELECT * FROM CMS_todo WHERE user_id = $user_id  ";
         $bob= fetchAndWrite($bobsql);
         $statement = $conn->prepare("SELECT * FROM CMS_todo WHERE user_id = ? ");
         $statement->bind_param("i", $user_id );

        if ($category && $statement->execute()) {
            $response->status = 200;
            $response->info = "GET";
            $response->data =$data;
            $response->user_id =$user_id;  
            $response->bob =$bob; 
        }
    }

        // Hämta todo lista
        else if ($_SERVER["REQUEST_METHOD"] === "PUT"&& end($request_uri)== 2) {
            $category = end($request_uri);
            $Order = $request_body->order;
            $bobsql = "SELECT * FROM CMS_todo WHERE user_id = $user_id ORDER BY `CMS_todo`.`due_date` $Order  ";
             $bob= fetchAndWrite($bobsql);
             $statement = $conn->prepare("SELECT * FROM CMS_todo WHERE user_id = ? ");
             $statement->bind_param("i", $user_id );
    
            if ($category && $statement->execute()) {
                $response->status = 200;
                $response->info = "PUT";
                $response->data =$data;
                $response->user_id =$user_id;  
                $response->bob =$bob; 
            }
        }

    // Updatera Done
    else if ($_SERVER["REQUEST_METHOD"] === "PUT") {
 
       $toDoId = $request_body->id; 
       $toChack = $request_body->done;
       $statement = $conn->prepare("UPDATE  CMS_todo  SET done = ? WHERE id = ?  ");
           $statement->bind_param("ii",$toChack , $toDoId );

          if ( $toDoId && $statement->execute()) {
              $response->status = 200;
              $response->info = "PUT";
              $response->toDoId = $toDoId;
              $response->toChack = $toChack;
          }
    }


    // Ta bort inlägg från todo
    else if ($_SERVER["REQUEST_METHOD"] === "DELETE") {
          $toDoId = $request_body->id; 
          $statement = $conn->prepare("DELETE FROM CMS_todo WHERE id = ?  ");
          $statement->bind_param("i", $toDoId );
          if ( $toDoId && $statement->execute()) {
           $response->status = 200;
           $response->info = "DELETE";
             }
    }
} else {
    $response->info = "API_KEY invalid";
}

$conn->close();
http_response_code($response->status);
print(json_encode($response));

?>
