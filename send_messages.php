<?php
session_start();
include("db.php");
// var_dump($_POST);
// echo "Session status: ".session_status()."<br><br>";

$textBox = filter_var(htmlentities(stripslashes($_POST['text_box'])));


/* --======= If login & password is exist in cookies  =======-- */
if (isset($_SESSION['username']) == true) {
    // Send message - Validation
    if ($textBox != "") {
        $result = $mysql->query(" INSERT INTO `messages` (`message_content`) VALUES('$textBox') ");

        if ($result != true) {
            echo "Sorry, something went wrong! Please refresh the web page and try send a message again.";
        }
    }
}

$result = $mysql->query(" SELECT * FROM `messages` WHERE 'message_content' != '' ");
while ($row = $result->fetch_assoc()) {
    echo $row["message_content"] . "<br>";
}



