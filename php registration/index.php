<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Document</title>
</head>
<body>
<h1>Регистрационная форма</h1>
<form method="post">
    <h2>Имя: </h2>
    <input type="text" name="name" required id="name">
    <p id="span1"></p>
    <h2>Почта: </h2>
    <input type="text" name="mail" required id="mail">
    <p id="span2"></p>
    <h2>Пароль: </h2>
    <input type="password" style="margin-bottom: 15px;" name="password" id="password" required>
    <p id="span3"></p>
    </br>
    <input type="submit" value="Регистрация" style="margin-bottom: 15px">
</form>
<button><a href="./auth.php" style="text-decoration: none; color: black">Страница входа</a></button>
<?php
if ($_SERVER["REQUEST_METHOD"] == "POST"):

    $email = $_POST['mail'];
    $validMail = filter_var($email, FILTER_VALIDATE_EMAIL);
    $password = md5($_POST['password']);
    $name = $_POST['name'];

    if(trim($name) == ''):
?>
    <script>
        let name = document.getElementById('name');
        name.setAttribute('class', 'error-mes');
        let text = document.getElementById('span1');
        text.innerHTML = "Введите корректное имя";
    </script>
    <?php
    exit();
    endif;
    if (trim($email) == '' || !$validMail):
    ?>
        <script>
            let name = document.getElementById('mail');
            name.setAttribute('class', 'error-mes');
            let text = document.getElementById('span2');
            text.innerHTML = "Введите корректный email";
        </script>
    <?php
    exit();
    endif;
    if(trim($password) == ''):
        ?>
        <script>
            let name = document.getElementById('password');
            name.setAttribute('class', 'error-mes');
            let text = document.getElementById('span3');
            text.innerHTML = "Введите корректный пароль";
        </script>
    <?php
    exit();
    endif;

    $mysql = new mysqli("localhost", "y922790i_my_db", "rooT123",  'y922790i_my_db');
    $mysql->query("SET NAMES 'utf8'");
    $dbEmails = $mysql->query("SELECT * FROM users")->fetch_all();
    foreach ($dbEmails as $key => $item) {
        if ($email == $dbEmails[$key][2]) {
            echo('<br>Данный почта уже зарегестрирована, <br> попробуйте войти в аккаунт <br>');
        }

    }

    $email = mysqli_real_escape_string($mysql, $email);
    $password = mysqli_real_escape_string($mysql, $password);
    $name = mysqli_real_escape_string($mysql, $name);

    if($mysql->connect_error) {
        echo "error: " . $mysql->connect_errno;
        echo "error: ".$mysql->connect_error;
    }

    if($mysql -> query("INSERT INTO `users` (`name`, `password`, `email`) VALUES ('$name', '$password', '$email')")){
        echo ("<br>Регистрация успешна<br>Пробуй войти в аккаунт");
    }

    $mysql->close();
    endif;
?>

</body>
</html>