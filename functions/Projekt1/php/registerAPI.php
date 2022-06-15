<form action="registerAPI.php" method="post">
    <table>
        <tbody>
            <tr>
                <td class="ts_style">user </td>
                <td> <input placeholder="Namn" type="text" name="usr" style="margin-left: 30px;"><br></td>
            </tr>
            <tr>
                <td class="ts_style"> api_key </td>
                <td> <input placeholder="Ex. 123456_Mki!" type="text" name="psw" style="margin-left: 30px;"> </td>
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
print("hello ammar");

$USER = $_REQUEST["usr"];
$PASS = $_REQUEST["psw"];
$ANN = $_REQUEST["ann"];
$_SESSION['test1'] = "";
if (isset($_REQUEST["usr"]) && isset($_REQUEST["psw"])) {
    print("0");

    $conn = create_conn();
    $sql = " SELECT * FROM CMS_users ";
    function fetchAndWrite($sql)
    {

        $conn = create_conn();
        if ($result = $conn->query($sql)) {
            //skapa en while loop för att hämta varje rad!
            if ($result = $conn->query($sql)) {
                print("USER" . $_REQUEST["usr"] . "0<br>");
                while ($row = $result->fetch_assoc()) {

                    if ($_REQUEST["usr"] == $row['username']) {
                        $_SESSION['test1'] = "finns";
                        print("han finns " . $row['username'] . "<br>");
                    }
                }
            }
        }
        print("test1: " . $_SESSION['test1'] . "<br>");
        print("user: " . $_REQUEST['usr']);
    }
    fetchAndWrite($sql);
  
    $conn->close();

    if ($USER != "" && $PASS != "" && $ANN != "" &&   $_SESSION['test1'] != "finns") {
        // Koppla till databasen
        $conn = create_conn();
        print("1");
        $username = test_input($_REQUEST['usr']); //användernamn
        $password = test_input($_REQUEST['psw']); // lösenord
        $password = hash("sha256", $password);
        $ANN = test_input($_REQUEST['ann']);
        $id = null;
        $api_key = $password;
        $widgets = $ANN;
        print("2");


        //INSERT INTO `CMS_users` (`id`, `api_key`, `username`, `widgets`) VALUES (NULL, 'a', 'a', 'a');
        // $statement = $conn->prepare("INSERT INTO CMS_users (id, api_key, username, widgets) VALUES (NULL, gsdffgsdffg, sdffgsdffg, sdffgsdffgs)");

        $statement = $conn->prepare("INSERT INTO   CMS_users (id, api_key, username, widgets) VALUES (?,?,?,? )");
        $statement->bind_param("isss", $id, $api_key, $username, $widgets);

        print("3");
        if ($statement->execute()) {
            print("Du har registrerats!");
            $_SESSION['test1'] = "";
            $conn->close();

            print("4");
        }
    } else {
        print(" <br> Du kan inte registera samma namn eller tomt input");
    }
}

?>