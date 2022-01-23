<?php
declare(strict_types=1);
namespace App\Controller;

require_once '../bootstrap.php';

use App\FlashMessage;
use App\Registry;
use App\Repository\MovieRepository;
use App\Repository\UserRepository;
use App\Response;
use Exception;
use PDOException;

class UserController
{
    public function login(){
        $errors = [];
        $lastUser = "";


        if (!empty($_COOKIE["last_used_name"]))
        {
            $lastUser = $_COOKIE["last_used_name"];
        }

        if (isPost()) {

            $userName = "";
            $pass = "";

            if (!empty($_POST["user"])) {
                $userName = $_POST["user"];
            } else {
                array_push($errors, "Has de introducir un nombre de usuario.");
            }

            if (!empty($_POST["pass"])) {
                $pass = $_POST["pass"];
            } else {
                array_push($errors, "Has de introducir una contraseña.");
            }

            if (count($errors) == 0) {

                $userRepo = new UserRepository();
                $userRepo->iniciarSesion($userName, $pass);
                $row = FlashMessage::get("row");
                if ($row != null) {
//                    $_SESSION["userLoged"][] = ["id" => $row["id"], "user" => $userName, "password" => $pass];
                    if(password_verify($pass, $row['password'])){
                        conectar($row["id"], $userName);
                    }else{
                        array_push($errors, "El usuario y la contraseña no coiciden. Por favor, vuelva a intentarlo");
                    }
                } else {
                    array_push($errors, "El usuario y la contraseña no coiciden. Por favor, vuelva a intentarlo");
                }

//                if (!array_key_exists("userLoged", $_SESSION)) {
//                    $userRepo = new UserRepository();
//                    $userRepo->iniciarSesion($userName, $pass);
//                    $row = FlashMessage::get("row");
//                    if ($row != null) {
//                        $_SESSION["userLoged"][] = ["id" => $row["id"], "user" => $userName, "password" => $pass];
//                        conectar($row["id"], $userName);
//                    } else {
//                        array_push($errors, "El usuario y la contraseña no coiciden. Por favor, vuelva a intentarlo");
//                    }
//
//                } else {
//                    $coincidencia = false;
//                    $coincidenciaIndex = -1;
//                    for ($i = 0; $i < count($_SESSION["userLoged"]); $i++) {
//                        if ($_SESSION["userLoged"][$i]["user"] == $userName && $_SESSION["userLoged"][$i]["password"] == $pass) {
//                            $coincidencia = true;
//                            $coincidenciaIndex = $i;
//                            break;
//                        }
//                    }
//                    if ($coincidencia == true) {
//                        conectar($_SESSION["userLoged"][$coincidenciaIndex]["id"], $_SESSION["userLoged"][$coincidenciaIndex]["user"]);
//                    } else {
//                        $userRepo = new UserRepository();
//                        $userRepo->iniciarSesion($userName, $pass);
//                        $row = FlashMessage::get("row");
//                        if ($row != null) {
//                            $_SESSION["userLoged"][] = ["id" => $row["id"], "user" => $userName, "password" => $pass];
//
//
//                            conectar($row["id"], $userName);
//                        } else {
//                            array_push($errors, "El usuario y la contraseña no coiciden. Por favor, vuelva a intentarlo");
//                        }
//                    }
//                }
            }
        }
        $response = new Response();
        $response->setView("login");
        $response->setLayout("backend");
        $response->setData(compact('errors'));
        return $response;
    }

    public function logout(){
        if(!empty($_COOKIE["last_used_name"])){
            setcookie("last_used_name", "", -1);
        }
        session_unset();
        session_destroy();

        header("Location: ".Registry::get(Registry::ROUTER)->generate("movie_list"));
    }

    public function register(){
        $errors = [];

        if (isPost()) {
            $userName = "";
            $pass = "";

            if(!empty($_POST["user"])){
                $userName = $_POST["user"];
            }else{
                array_push($errors, "Has de introducir un nombre de usuario.");
            }

            if(!empty($_POST["pass"])){
                $pass = $_POST["pass"];
            }else{
                array_push($errors, "Has de introducir una contraseña.");
            }

            if(count($errors) == 0){
                $userRepo = new UserRepository();
                $pass = password_hash($pass, PASSWORD_DEFAULT);;
                $userRepo->registrarse($userName, $pass);

                array_push($errors, FlashMessage::get("errors"));

                if($errors[0] == ''){
                    header("Location: ".Registry::get(Registry::ROUTER)->generate("user_login"));
                    exit;
                }
            }
        }
        $response = new Response();
        $response->setView("register");
        $response->setLayout("backend");
        $response->setData(compact('errors'));
        return $response;
    }
}