<?php
session_start();
include("db.php");

$login = filter_var(trim($_POST['login']),
    FILTER_SANITIZE_STRING);

$originalUserPSW = $_POST['password'];

// Log In Form
// Проверяем поля на пустоту
if (mb_strlen($login) == 0 || mb_strlen($originalUserPSW) == 0) {
    echo "All fields are required! <br><a href='index.php'>Log In</a> | <a href='registration.php'>Registration</a>";
} else {
    $result = $mysql->query(" SELECT * FROM `users` WHERE `login` = '$login' ");

    // mysqli_fetch_assoc - Обрабатывает ряд результата запроса и возвращает ассоциативный массив.
    // mysqli_fetch_array --  Обрабатывает ряд результата запроса, возвращая ассоциативный массив, численный массив или оба.
    /*
     * mysqli_fetch_assoc() как сказали возвращает результат в виде ассоциативного массива.
     * mysqli_fetch_array() - тип возвращаемого массива может быть задан во втором необязательном параметре.
     * ------------------------------------------------------------------------------------------------------------
     * mysqli_fetch_assoc - массив только вида $arr['key1']
     * mysqli_fetch_array - можно обращаться как $arr['key1'], так и $arr[0] (если запускать без второго ключа)
     */
    $row = $result->fetch_assoc();

    if (($login == $row['login']) && (password_verify($originalUserPSW, $row['password']))) {
        $_SESSION["username"] = $login;
        $_SESSION["password"] = $originalUserPSW;

        // echo "Congratulation! <br><a href='index.php'>Back to Home page</a>";
        header("location: index.php");
    } else {
        echo "Wrong username or password!";
    }
}