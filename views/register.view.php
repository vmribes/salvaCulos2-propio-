<!--<!DOCTYPE html>-->
<!--<html lang="ca">-->
<!--<head>-->
<!--    <meta charset="utf-8">-->
<!--    <title>Registrar Nuevo Usuario</title>-->
<!--    <meta name="description" content="PHP, PHPStorm">-->
<!--    <meta name="author" content="Homer Simpson">-->
<!--    <style>-->
<!--        body {-->
<!--            font-family: "Bitstream Vera Serif"-->
<!--        }-->
<!--    </style>-->
<!--</head>-->

<!--<body>-->
<h1>Registrar Nuevo Usuario</h1>
<form action="" method="post">
    <p>Nombre de Usuario <input type="text" name="user" id="user"> </p>
    <p>Contraseña <input type="password" name="pass" id="pass"> </p>
    <input type="submit" value="Registrar al Usuario">
</form>
<br>
<ul>
    <?php

    use App\Registry;

    if(count($errors) > 0){
        for($i = 0; $i < count($errors); $i++){
            ?>
            <li><?php echo $errors[$i]; ?></li>
            <?php
        }
    }

    ?>
</ul>
<button><a href="<?= Registry::get(Registry::ROUTER)->generate("user_login") ?>">Cancelar</a></button>
<!--</body>-->
<!--</html>-->