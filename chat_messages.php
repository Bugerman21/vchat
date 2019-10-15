<?php
include("db.php");

$q = $_POST['chat_id'];

$result = $mysql->query(" SELECT * FROM `messages` WHERE `chat_id` = '$q' ");
while($row  = $result->fetch_assoc()) {
    echo $row["message_content"]."<br>";
}



