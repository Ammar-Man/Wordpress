<form action="register.php" method="post">
    <table>
        <tbody>
            <tr>
                <td class="ts_style">user </td>
                <td> <input placeholder="Namn" type="text" name="usr" style="margin-left: 30px;"><br></td>
            </tr>
            <tr>
                <td class="ts_style"> api_key </td>
                <td> <input placeholder="Ex. 123456_Mki!" value="<?php print($_COOKIE["api_key"]) ?>" type="text" name="psw" style="margin-left: 30px;"> </td>
            </tr>
            <tr>
                <td class="ts_style">widgets</td>
                <td> <input placeholder="Vem är du?" type="text" name="ann" style="margin-left: 30px;"><br></td>
            </tr>
        </tbody>
    </table>
    <input type="hidden" name="stage" value="register">
    <input type="submit" value="Registera dig" class="button">
</form>

<?php include "init.php" ?>
<?php

function fetchAndWrite($conn, $sql)
{
    if ($result = $conn->query($sql)) {
        // Skapa en while loop för att hämta varje rad!
        if ($result = $conn->query($sql)) {
            while ($row = $result->fetch_assoc()) {
                $api_key = hash("sha256", $_REQUEST["psw"]);
                if ($api_key == $row['api_key']) {
                    $_SESSION['test1'] = "finns";
                }
            }
        }
    }
}

$USER = $_REQUEST["usr"]; // usr
//$PASS = $_REQUEST["psw"]; // API_KEY
$PASS = $_COOKIE["api_key"];

print($PASS);

$ANN = $_REQUEST["ann"]; // Widgets
$_SESSION['test1'] = "";
if (isset($_REQUEST["usr"]) && isset($_REQUEST["psw"])) {
    print("0");

    $conn = create_conn();
    $sql = "SELECT * FROM CMS_users";

    print("USER" . $_REQUEST["usr"] . "0<br>");

    fetchAndWrite($conn, $sql);

    if ($_SESSION['test1'] != "finns") {
        print("Han finns " . $row['api_key'] . "<br>");
    }

    print("test1: " . $_SESSION['test1'] . "<br>");
    print("user: " . $_REQUEST['usr']);

    if ($USER != "" && $PASS != "" && $ANN != "" && $_SESSION['test1'] != "finns") {
        // Koppla till databasen
        print("1");
        $username = test_input($_REQUEST['usr']); //användernamn
        $api_key = test_input($_REQUEST['psw']); // api-key
        $api_key = hash("sha256", $api_key);
        //$ANN = test_input($_REQUEST['ann']);
        $id = null;
        $widgets = $ANN;
        print("2");

        //INSERT INTO `CMS_users` (`id`, `api_key`, `username`, `widgets`) VALUES (NULL, 'a', 'a', 'a');
        // $statement = $conn->prepare("INSERT INTO CMS_users (id, api_key, username, widgets) VALUES (NULL, gsdffgsdffg, sdffgsdffg, sdffgsdffgs)");

        $statement = $conn->prepare("INSERT INTO CMS_users (id, api_key, username, widgets) VALUES (?,?,?)");
        $statement->bind_param("sss", $api_key, $username, $widgets);

        print("3");
        if ($statement->execute()) {
            print("Du har registrerats!");
            $_SESSION['test1'] = "";
            print("4");
        }
    } else {
        print(" <br> Du kan inte registera samma API-KEY eller tomt input");
    }

    $conn->close();
}

?>