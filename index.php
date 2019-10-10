<?php

    // Запускаем сессию для работы с кукис файлами
    session_start();
// var_dump($_SESSION);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>VChat</title>

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
    <link rel="icon" type="image/png" href="Chat.ico">
    <!--===================================================================================================-->
</head>
<body class="">
<div class="wrapper fadeInDown">
    <?php
    // Если отсутствуют логин и пароль,
    // отображаем форму входа и регистрации
    if (!isset($_SESSION['login']) && !isset($_SESSION['password'])) {
        ?>

        <!--======= Log In form =====-->
        <!--===============================-->
        <div id="formContent">
            <!-- Tabs Titles -->
            <h1>Welcome to VChat</h1>
            <h6>Please Log In</h6>

            <!-- Login Form -->
            <form action="check.php" method="post">
                <input type="text" id="login" class="fadeIn" name="login" placeholder="Login">
                <input type="password" id="password" class="fadeIn" name="password" placeholder="Password">
                <input type="hidden" name="form" value="login"></input>
                <input type="submit" class="fadeIn fourth" value="Log In">
            </form>

            <!-- Remind Password / Log In -->
            <div>
                | <a href="#">Forgot Password?</a> |
                <a href="registration.php" class="mb-2">Registration</a> |
            </div>
        </div>




        <?php
    }
    else {
    ?>
    <h3>Тили тили, трали вали - ты смог зайдти!</h3>
    <?php

    }
    ?>
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