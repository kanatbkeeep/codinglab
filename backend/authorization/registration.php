<?php
$dbc = mysqli_connect('localhost', 'root', '', 'codingLab') OR DIE('<p class="">Ошибка подключения к базе данных </p>');

$login = filter_var(trim($_POST['login']),
    FILTER_SANITIZE_STRING);

$name = filter_var(trim($_POST['name']),
    FILTER_SANITIZE_STRING);

$surname = filter_var(trim($_POST['surname']),
    FILTER_SANITIZE_STRING);

$email = filter_var(trim($_POST['email']),
    FILTER_SANITIZE_STRING);

$uin = filter_var(trim($_POST['uin']),
    FILTER_SANITIZE_STRING);

$pass = filter_var(trim($_POST['pass']),
    FILTER_SANITIZE_STRING);


$query = "SELECT * FROM `users` WHERE login = '$login'";
$data = mysqli_query($dbc, $query);

if(mysqli_num_rows($data) == 0) {
    $mysql = new  mysqli('localhost', 'root', '','codingLab');
    $mysql -> query("INSERT INTO `users` (`login`, `name` , `surname` , `email`, `uin`, `pass`)
    VALUES('$login', '$name' , '$surname' , '$email' , '$uin', '$pass')");

    $result = $mysql->query("SELECT * FROM `users` WHERE `login` = '$login' AND `pass` = '$pass'");
    $user = $result-> fetch_assoc();

    setcookie('user', $user['login'], time() + (60*60*24*30), '/');

    $mysql -> close();

    header('Location: /codinglab/index.php');
} else {
    mysqli_close($dbc);
    header('Location: /codinglab/registration.php?id=1');
}