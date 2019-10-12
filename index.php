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
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <!--===================================================================================================-->


    <!-- Web icon -->
    <link rel="icon" type="image/png" href="Chat.ico">
    <!--===================================================================================================-->
</head>

<body class="">
<div class="wrapper">
    <?php /*-------------------------------------------------------------> OPEN PHP */
    if (!isset($_SESSION['login']) && !isset($_SESSION['password'])) { // Если отсутствуют логин и пароль, отображаем форму входа и регистрации
        /*---------------------------------------------------------------> CLose PHP */ ?>


        <!--======= Log In form =====-->
        <!--=========================-->
        <div id="formContent">
            <!-- Tabs Titles -->
            <h1>Welcome to VChat</h1>
            <h6>Please Log In</h6>

            <!-- Login Form -->
            <form action="check.php" method="post">
                <input type="text" name="login" placeholder="Login">
                <input type="password" name="password" placeholder="Password">
                <input type="hidden" name="form" value="login">
                <input type="submit" value="Log In">
            </form>

            <!-- Remind Password / Log In -->
            <div>
                | <a href="#">Forgot Password?</a> |
                <a href="registration.php" class="mb-2">Registration</a> |
            </div>
        </div>

        <?php /*---------------------------------------------------------> OPEN PHP */
    } else {
        /*---------------------------------------------------------------> CLose PHP */ ?>


        <!-- HEADER -->
        <header class="b_red container-fluid">
            <h1 class="text-center t_darkgrey">VChat</h1>
        </header>

        <!-- MAIN -->
        <main class="container-fluid p-0 m-0 d-flex">

            <aside class="b_blue">
                <!-- Chat header -->
                <section>
                    <img src="" alt="qq" class="chat_logo">
                    <div>
                        <h6>Chat name</h6>
                        <p class="ts_small">Last message in the chat</p>
                    </div>
                </section>
            </aside>

            <article class="q flex-md-grow-1">
                <section class="chat_header d-flex b_black">
                    <div class="chat_logo mx-3">Chat avatar</div>
                    <h4>Chat name</h4>
                </section>
                <section id="chatMsg" class="chat_messages">

                </section>
                <section class="b_green text_box_wrapper ">
                    <form action="check.php" method="post" class="d-flex">
                        <textarea name="text_box" placeholder="Type a message..." autofocus></textarea>
                        <input type="submit" value="Send message">
                    </form>
                </section>
            </article>
        </main>

        <!-- FOOTER -->
        <footer>
            <a href="exit.php">Exit</a>
        </footer>

        <?php /*---------------------------------------------------------> OPEN PHP */
    }
    /*-------------------------------------------------------------------> CLOSE PHP */ ?>
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
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>



<script>
    $.ajax({
       // type: "POST",
        url: "chat_messages.php",
        success: function(result) {
            $('#chatMsg').html(result);
        }
    });
</script>

<script>
    // Обновление раз в 3 секунд
    // window.location.reload()
    //setTimeout
    setInterval(function(){
console.log("im here");
        $.ajax({
            // type: "POST",
            url: "chat_messages.php",
            success: function(result) {
                $('#chatMsg').html(result);
            }
        });

        },3000);
</script>

</body>
</html>