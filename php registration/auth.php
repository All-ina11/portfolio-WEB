<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="style.css">
    <title>Document</title>
</head>
<body>
<h1>Форма входа</h1>
<form method="post">
    <h2>Почта: </h2>
    <input required type="email" name="email" id="email">
    <p id="span1"></p>
    <h2>Пароль: </h2>
    <input required type="password" name="password" id="password" style="margin-bottom: 15px">
    <p id="span2"></p>
    <br>
    <input type="submit" value="Войти" style="margin-bottom: 15px">
</form>

<button><a href="index.php" style="text-decoration: none; color: black">Страница регистрации</a></button>

<?php
        if ($_SERVER["REQUEST_METHOD"] == "POST"):
            $email = $_POST["email"];
            $password = ($_POST["password"]);

            if (trim($email) == '' || !filter_var($email, FILTER_VALIDATE_EMAIL)):
            ?>
                <script>
                    let email = document.getElementById('email');
                    email.setAttribute('class', 'error-mes');
                    let text = document.getElementById('span1');
                    text.innerHTML = "Введите корректный email";
                </script>
            <?php
            exit();
            endif;
            if (trim($password) == ''):
            ?>
                <script>
                    let pass = document.getElementById('password');
                    pass.setAttribute('class', 'error-mes');
                    let text = document.getElementById('span2');
                    text.innerHTML = "Введите корректный пароль";
                </script>
            <?php
            exit();
            endif;

            $mysql = new mysqli("localhost", "y922790i_my_db", "rooT123",  'y922790i_my_db');
            $mysql->query("SET NAMES 'utf8'");

            if($mysql->connect_error) {
                echo ($mysql->connect_errno) . " " . $mysql->connect_error;
            }
            $res = $mysql->query("SELECT * FROM `users`");
            while ($row = $res->fetch_assoc()) {
                if ($email == $row["email"] && md5($password) == $row["password"]) {
                    echo ("<h1>Вы вошли в аккаунт</h1>");
                    exit();
                }
                else {
                    echo ("<h1>Неверный пароль или данный аккаунт не зарегестрирован, попробуйте еще раз<h1>");
                    exit();
                }
            }
            endif;
?>
</body>
</html>