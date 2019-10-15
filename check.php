<?php
session_start();
include("db.php");
// var_dump($_POST);

/**
 * filter_var - фильтрует различные html символы,
 * и символы которые не желательно вводить в БД
 */
// Trim - удаляет пробелы
// FILTER_SANITIZE_STRING - указывает/принимает тип фильрации (в данном случае фильтруем как обычную строку)
// filter_var() - Фильтрует переменную с помощью определенного фильтра

$name = filter_var(trim($_POST['name']),
    FILTER_SANITIZE_STRING);

$lastName = filter_var(trim($_POST['lastName']),
    FILTER_SANITIZE_STRING);

$nickName = filter_var(trim($_POST['nickName']),
    FILTER_SANITIZE_STRING);

$login = filter_var(trim($_POST['login']),
    FILTER_SANITIZE_STRING);

// Пароли никогда не фильтруется он и задуман для того чтобы состоять из любых символов
$originalUserPSW = $_POST['password'];
$confirmPSW = $_POST['pswConfirm'];

$email = filter_var(trim($_POST['email']),
    FILTER_SANITIZE_STRING);

$form = $_POST['form']; /* Log In Form */

// filter_var() - Фильтрует переменную с помощью определенного фильтра
// trim() - Удаляет пробелы (или другие символы) из начала и конца строки
// htmlspecialchars() - Преобразует специальные символы в HTML-сущности
/** Пример
 * & (амперсанд) - заменится на &amp;
 * " (двойные кавычки) - заменится на &quot;, если не установлена ENT_NOQUOTES
 * < (меньше) - заменится на &lt;
 * и так далее...
 */
// есть еще htmlentities() Эта функция идентична htmlspecialchars() за исключением того, что htmlentities() преобразует все символы в соответствующие HTML-сущности (для тех символов, для которых HTML-сущности существуют).
// stripslashes() - Удаляет экранирование символов, пример: $str = "Ваc зовут O\'reilly?"; --> выводит: Вас зовут O'reilly?

/*================================ Проверки ===================================*/
/*=============================================================================*/
// mb_strlen() - возвращает количество символов в строке str, имеющих кодировку символов encoding. Многобайтный символ вычисляется как 1 (почти всегда будем использовать его).
// strlen - Возвращает длину строки string (используется только для англ.языка - поэтому не так популярен как mb_strlen).


// Registation Form
if ($form == "reg") {
    // Проверяем длину имени
    if (mb_strlen($name) < 4 || mb_strlen($name) > 20) {
        echo "The Name mast be not less than 4 chars and not more than 20 chars! <br><a href='index.php'>Log In</a> | <a href='registration.php'>Registration</a>";
    } // Проверяем длину фамилии
    else if (mb_strlen($lastName) < 4 || mb_strlen($lastName) > 20) {
        echo "The Last Name mast be not less than 4 chars and not more than 20 chars! <br><a href='index.php'>Log In</a> | <a href='registration.php'>Registration</a>";
    } // Проверяем длину псевдонима
    else if (mb_strlen($nickName) < 4 || mb_strlen($nickName) > 20) {
        echo "The Name mast be not less than 4 chars and not more than 20 chars! <br><a href='index.php'>Log In</a> | <a href='registration.php'>Registration</a>";
    } // Проверяем длину логниа
    else if (mb_strlen($login) < 4 || mb_strlen($login) > 20) {
        echo "The Login mast be not less than 4 chars and not more than 20 chars! <br><a href='index.php'>Log In</a> | <a href='registration.php'>Registration</a>";
    } // Проверяем длину пароля
    else if (mb_strlen($originalUserPSW) < 4 || mb_strlen($originalUserPSW) > 20) {
        echo "The Password mast be not less than 4 chars and not more than 20 chars! <br><a href='index.php'>Log In</a> | <a href='registration.php'>Registration</a>";
    } else if ($originalUserPSW != $confirmPSW) {
        echo "The Password do not match! <br><a href='index.php'>Log In</a> | <a href='registration.php'>Registration</a>";
    } // Проверяем длину эл.почты
    else if (mb_strlen($email) < 4 || mb_strlen($email) > 40) {
        echo "The Email mast be not less than 4 chars and not more than 40 chars! <br><a href='index.php'>Log In</a> | <a href='registration.php'>Registration</a>";
    } else { // Когда валидация форм прошла успешно
        // Кодировка / хеширование пароля
        $password = password_hash($originalUserPSW, PASSWORD_DEFAULT);

        //Вставляем данные в БД
        $result = $mysql->query(" INSERT INTO `users` (`name`,`lastname`,`nickname`,`login`,`password`,`email`) VALUES('$name','$lastName','$nickName','$login','$password','$email') ");

        //Если данные успешно занесены в таблицу
        if ($result == true) {
            // echo "Вы успешно зарегистрированы! <br><a href='index.php'>На главную</a>";
            header("location: index.php");
        } //Если не так, то выводим ошибку
        else {
            echo "Error! ----> ";
        }
    }
}




// $mysql->close();