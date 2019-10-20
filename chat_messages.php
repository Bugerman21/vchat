<?php
include("db.php");

$q = $_POST['chat_id'];

$result = $mysql->query(" SELECT * FROM `messages` WHERE `chat_id` = '$q' ");
while($row  = $result->fetch_assoc()) {
    $array[] = array(
        "msgcont" => $row["message_content"],
        "chatid" => $row["chat_id"],
    );
}
$v = json_encode($array);

echo($v);

//json_encode

