<?php
//Запускаем сессию для работы с кукис
session_start();

//Так как пользователь хотел выйти,
//удаляем ему логин и id из кукисов
unset($_SESSION['login']);
unset($_SESSION['password']);

session_destroy();

//Переадресовываем на главную
header("location: index.php");
?>
