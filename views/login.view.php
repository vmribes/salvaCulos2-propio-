<!--<!DOCTYPE html>-->
<!--<html lang="ca">-->
<!--<head>-->
<!--    <meta charset="utf-8">-->
<!--    <title>Iniciando Sesión</title>-->
<!--    <meta name="description" content="PHP, PHPStorm">-->
<!--    <meta name="author" content="Homer Simpson">-->
<!--    <style>-->
<!--        body {-->
<!--            font-family: "Bitstream Vera Serif"-->
<!--        }-->
<!--    </style>-->
<!--</head>-->
<!---->
<!--<body>-->
<?php
use App\Registry;

?>
<h1>Iniciar Sesión:</h1>
<form action="" method="post">
<!--    <p>Nombre de Usuario <input type="text" name="user" id="user" value="-->
<?php //use App\Registry;
//
//        if($lastUser != ""){echo $lastUser;} ?><!--"> </p>-->
    <p>Nombre de Usuario <input type="text" name="user" id="user"> </p>
    <p>Contraseña <input type="password" name="pass" id="pass"> </p>
    <input type="submit" value="Iniciar Sesión">
</form>
<br>
<ul>
    <?php
    if(count($errors) > 0){
        for($i = 0; $i < count($errors); $i++){
            ?>
            <li><?php echo $errors[$i]; ?></li>
            <?php
        }
    }

    ?>
</ul>
<button><a href="<?= Registry::get(Registry::ROUTER)->generate("user_register") ?>">Registrar Nuevo Usuario</a> </button>
<!--</body>-->
<!--</html>-->