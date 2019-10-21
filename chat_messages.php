<?php
include("db.php");

$chatId = $_POST['chat_id'];

$result = $mysql->query(" SELECT * FROM `messages` WHERE `chat_id` = '$chatId ' ");
$chat_type_result = $mysql->query(" SELECT * FROM `chat` WHERE `chat_id` = '$chatId ' ");
while ($row = $result->fetch_assoc()) {
    // array withj [] add elemnts to the end
    $array[] = array(
        "msgcont" => $row["message_content"],
        "chatid" => $row["chat_id"],
        "typeofchat" => $row["chat_type"],
        "chatname" => $row["chat_name"],
    );
}
$json_result = json_encode($array);

echo($json_result);


