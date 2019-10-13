<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>VChat - Registration</title>

    <!-- Required meta tags -->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <!--===================================================================================================-->


    <!-- Bootstrap CSS -->
    <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet"/>
    <!--===================================================================================================-->

    <!-- fontawesome-free-5.0. CSS -->
    <link href="fontawesom/web-fonts-with-css/css/fontawesome-all.min.css" rel="stylesheet">
    <!--===================================================================================================-->

    <!-- My styles CSS -->
    <link rel="stylesheet" type="text/css" href="css/authorize_css/main.css">
    <!--===================================================================================================-->


    <!-- Web icon -->
    <link rel="icon" type="image/png" href="chat.ico">
    <!--===================================================================================================-->
</head>
<body class="">
<div class="wrapper fadeInDown">
    <?php

    // Запускаем сессию для работы с кукис файлами
    // session_start();
    // Если отсутствуют логин и айди,
    // отображаем форму входа и регистрации
    if (!isset($_SESSION['login']) || !isset($_SESSION['id'])) {
        ?>

        <!--======= Registration form =====-->
        <!--===============================-->
        <div id="formContent">
            <!-- Tabs Titles -->
            <h1>Registration</h1>
            <h6>All fields are required</h6>

            <!-- Register Form -->
            <form action="check.php" method="post">
                <input type="text" class="fadeIn" name="name" placeholder="Name">
                <input type="text" class="fadeIn" name="lastName" placeholder="Last name">
                <input type="text" class="fadeIn" name="nickName" placeholder="Nickname">
                <input type="text" class="fadeIn" name="login" placeholder="Login">
                <input type="password" class="fadeIn" name="password" placeholder="Password">
                <input type="password" class="fadeIn" name="pswConfirm" placeholder="Confirm password">
                <input type="text" class="fadeIn" name="email" placeholder="E-Mail">
                <input type="hidden" name="form" value="reg"></input>
                <input type="submit" class="fadeIn" value="Register">
            </form>

            <!-- Remind Password / Log In -->
            <div>
                | <a href="#">Forgot Password?</a> |
                <a href="index.php" class="mb-2">Log In</a> |
            </div>
        </div>

        <?php
    }

    //Если сессия запущена, то есть присутствуют файлы
    //кукис, и в них есть логин и айди
    //то отображаем профиль пользователя
    //Для этого достаем из базы все данные по логину
    //и выводим их на странице
    if (isset($_SESSION['login']) && isset($_SESSION['id'])) {
        include("db.php");
        $user = $_SESSION['login'];
        $psw = $_SESSION['login'];
        $res = mysqli_query(" SELECT * FROM `users` WHERE `login`='$user' AND `password`='$psw' ");
        // mysqli_fetch_assoc - Обрабатывает ряд результата запроса и возвращает ассоциативный массив.
        // mysqli_fetch_array --  Обрабатывает ряд результата запроса, возвращая ассоциативный массив, численный массив или оба.
        /*
         * mysqli_fetch_assoc() как сказали возвращает результат в виде ассоциативного массива.
         * mysqli_fetch_array() - тип возвращаемого массива может быть задан во втором необязательном параметре.
         * ------------------------------------------------------------------------------------------------------------
         * mysqli_fetch_assoc - массив только вида $arr['key1']
         * mysqli_fetch_array - можно обращаться как $arr['key1'], так и $arr[0] (если запускать без второго ключа)
         */

        $user_data = mysqli_fetch_array($res);
        echo "<center>";
        echo "Ваш логин: <b>" . $user_data['login'] . "</b><br>";
        echo "Ваше имя: <b>" . $user_data['name'] . "</b><br>";

        echo "<a href='exit.php'>Выход</a>";
        echo "</center>";
    }
    ?>

    <!-- Remind Password -->
    <!--<div>
        | <a href="#">Forgot Password?</a> |
        <a href="#"  class="mb-2">Registration</a> |
    </div>-->

</div><!-- .wrapper -->

<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"
        integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN"
        crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"
        integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q"
        crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"
        integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl"
        crossorigin="anonymous"></script>
</body>
</html>