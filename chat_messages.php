<?php
include("db.php");

$chatId = $_POST['chat_id'];

$result = $mysql->query(" SELECT * FROM `messages` WHERE `chat_id` = '$chatId' ");

$chat = $mysql->query(" SELECT * FROM `chat` WHERE `chat_id` = '$chatId' ");
$chat_raw = $chat->fetch_assoc();


$tempRow = $result->fetch_assoc();
$tempUser = $tempRow['sender'];

$user = $mysql->query(" SELECT * FROM `users` WHERE `login` = '$tempUser' ");
$senderRow = $user->fetch_assoc();




while ($row = $result->fetch_assoc()) {
    // array withj [] add elemnts to the end
    $array[] = array(
        "msgcont" => $row["message_content"],
        "chatid" => $row["chat_id"],
        "chattype" => $chat_raw['chat_type'],
        "chatname" => $chat_raw["chat_name"],
        "user" => $senderRow["login"],
        "nick" => $senderRow["nickname"],
    );
}



$json_result = json_encode($array);

echo($json_result);


