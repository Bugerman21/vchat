<?php
session_start();
include("db.php");

$result = $mysql->query(" SELECT * FROM `messages` WHERE 'message_content' != '' ");
while($row  = $result->fetch_assoc()) {
    echo $row["message_content"]."<br>";
}



