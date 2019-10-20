<?php
include("db.php");

$q = $_POST['chat_id'];

$result = $mysql->query(" SELECT * FROM `messages` WHERE `chat_id` = '$q' ");
while ($row = $result->fetch_assoc()) {
    // array withj [] add elemnts to the end
    $array[] = array(
        "msgcont" => $row["message_content"],
        "chatid" => $row["chat_id"],
    );
}
$json_result = json_encode($array);

echo($json_result);


