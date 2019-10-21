<?php
session_start();
include("db.php");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>VChat</title>

    <!-- Required meta tags -->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <!-- Web icon -->
    <link rel="icon" type="image/png" href="chat.ico">

    <!-- Bootstrap CSS -->
    <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet"/>
    <!-- fontawesome-free-5.0. CSS -->
    <link href="fontawesom/web-fonts-with-css/css/fontawesome-all.min.css" rel="stylesheet">
    <!-- My styles CSS -->
    <link rel="stylesheet" type="text/css" href="css/style.css">
</head>

<body class="">
<div class="wrapper">
    <?php
    /* --======= If login & password is not exist in cookies, show log in form  =======-- */
    /* --=================================== Start ====================================-- */
    if (!isset($_SESSION['login']) && !isset($_SESSION['password'])) {
        ?>

        <!--======= Log In form =====-->
        <!--=========================-->
        <div id="formContent">
            <!-- Tabs Titles -->
            <h1>Welcome to VChat</h1>
            <h6>Please Log In</h6>

            <!-- Login Form -->
            <form id="login" action="login.php" method="post">
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

        <?php
    }
    /* --==================================== End =====================================-- */
    /* --==============================================================================-- */
    /* --==============================================================================-- */
    /* --========================== Else show main content  ===========================-- */
    /* --=================================== Start ====================================-- */
    else {
        ?>
        <!-- MAIN -->
        <main class="container-fluid p-0 m-0 d-flex">
            <aside class="b_blue">
                <!-- User panel -->
                <section class="d-flex b_black">
                    <!-- Click on user avatar and will show big picture + information about him -->
                    <!-- will option change info -->
                    <div class="mx-3">
                        <img src="" alt="User avatar">
                        <?php
                        // $result = $mysql->query(" SELECT `nickname` FROM `users` WHERE `id` = '23' ");
                        echo "<h5 class='mb-1 font-weight-bold'>" . $_SESSION["username"] . "</h5>";
                        ?>
                    </div>
                    <!-- Will open window with create chat form - chat name, avatar, privet or not  -->
                    <!-- subname for chat - optional  -->
                    <a href="#" class="mr-1" title="Create chat"><i class="fas fa-plus"></i></a>
                </section>

                <!-- Chats list -->
                <section>
                    <div class="m-2">
                        <?php
                        $result = $mysql->query(" SELECT * FROM `chat` WHERE `chat_name` != '' ");
                        while ($row = $result->fetch_assoc()) {
                            echo "<h6 class='chat_name' onclick='chatRefresh(\"" . $row["chat_id"] . "\")'> - " . $row["chat_name"] . "</h6>";
                        }
                        ?>
                    </div>
                </section>
            </aside>

            <article class="q flex-md-grow-1">
                <!-- Chat header -->
                <section class="chat_header d-flex b_black">
                    <div class="chat_logo mx-3">Chat avatar</div>
                    <h4 id="headerChatName"></h4>
                </section>

                <!-- Chat message content -->
                <section id="chatMsg" class="chat_messages">

                </section>

                <!-- Chat text box -->
                <section class="b_green text_box_wrapper">
                    <form id="sendMSG" action="send_messages.php" method="post" class="d-flex">
                        <textarea name="text_box" placeholder="Type a message..." autofocus></textarea>
                        <input type="hidden" id="chatID" name="chatID" value="">
                        <input type="hidden" name="sender" value="<?php echo $_SESSION['username']?>">
                        <input type="submit" value="Send message" this.form.reset()>
                    </form>
                </section>
            </article>
        </main>

        <!-- FOOTER -->
        <footer>
            <a class="mx-2" href="exit.php">Exit <i class="fas fa-sign-out-alt"></i></a>
        </footer>

        <?php
    }
    /* --==================================== End =====================================-- */
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
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>

<!-- Login -->
<script type="text/javascript">
    $('#login').submit(function (e) {
        e.preventDefault();
        var data = $(this).serialize();
        $.ajax({
            type: "POST",
            url: "login.php",
            data: data,
            success: function () {
                location.reload();
                console.log("I am here ! - 1");
                setTimeout(function () {
                    $.ajax({
                        url: "chat_messages.php",
                        done: function (result) {
                            console.log("I am here ! - 2");
                            $('#chatMsg').html(result);
                        }
                    });
                }, 0);
            }
        });
    });
</script>

<!-- Send message -->
<script type="text/javascript">
    //$(document).ready(function () {
    $('#sendMSG').submit(function (e) {
        e.preventDefault();
        var data = $(this).serialize();
        $.ajax({
            type: "POST",
            url: "send_messages.php",
            data: data,
            success: function (result) {

                // clear form fields
                $("#sendMSG").trigger('reset');
                chatRefresh(result);
            }
        });
    });
    //});
</script>

<!-- Chose chat and update chat messages -->
<script type="text/javascript">
    let myVar

    function chatRefresh(temp) {
        $.ajax({
            method: "POST",
            url: "chat_messages.php",
            data: {
                "chat_id": temp
            },
            success: function (result) {
                let obj = JSON.parse(result);
                let text = "";
                console.log(result);
                $('#chatID').val(obj[0].chatid);

                obj.forEach(function (item, i, obj) {
                    message = "<span>";
                    message += obj[i].msgcont + "</span><br>";
                    text += message
                });
                setTimeout(function () {
                    $('#chatMsg').html(text);
                    $('#headerChatName').html(obj[0].chatname);
                }, 0);
                test(temp);

            }
        });
    }
</script>

<!-- Refresh chat messages -->
<script type="text/javascript">
    function test(temp) {
        clearTimeout(myVar);
        myVar = setInterval(function () {
            $.ajax({
                method: "POST",
                url: "chat_messages.php",
                data: {
                    "chat_id": temp
                },
                success: function (result) {
                    let obj = JSON.parse(result);
                    let text = "";

                    $('#chatID').val(obj[0].chatid);

                    obj.forEach(function (item, i, obj) {
                        message = "<span>";
                        message += obj[i].msgcont + "</span><br>";
                        text += message
                    });

                    $('#chatMsg').html(text);
                }
            });
        }, 2000);
    };
</script>

</body>
</html>