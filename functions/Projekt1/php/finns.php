
<?php
   $conn = create_conn();
         $sql = " SELECT * FROM CMS_users ";
         fetchAndWrite($sql);
         function fetchAndWrite($sql)
         {
            $conn = create_conn();
            if ($result = $conn->query($sql)) {
               //skapa en while loop för att hämta varje rad!
               while ($row = $result->fetch_assoc()) {
                  //skriv ut endast ett värde (en kolum en rad -- en cell)
                  print(' <div class="recipes-list">');
                  print("ID: " . $row['id'] . "<br>");
                  print("User: " . $row['username'] . "<br>");
                  print("Widgets: " . $row['widgets'] . "<br>");

                  $api =  hash("sha256", $row['api_key'] );
                  print("Api_key: " . $api . "<br>");
                  print('</div>');
                  echo '<br>';
               }
            } else {
               print("Något gick fel, query metoden senaste felet : " . $conn->error);
            }
         }
        $conn->close();
?>
