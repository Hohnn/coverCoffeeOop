<?php 

namespace App\Controllers;

class AuthController extends Controller
{
    public function login()
    {
        $this->viewEmpty('auth/login');
        
    }

    public function loginAuth()
    {
        // login and create session
        $mail = htmlspecialchars($_POST['mail']);
        $password = htmlspecialchars($_POST['password']);
        $user = $this->getUserByMail($mail);
        if ($user) {
            if (password_verify($password, $user->USER_PASSWORD)) {
                $_SESSION['user'] = $user;
                $_SESSION['id'] = $user->USER_ID;  
                setcookie('user', json_encode($user));
                $this->view('home/home');
            } else {
                $errorPass = 'Ce mot de passe n’est pas valide.';
                $this->viewEmpty('auth/login' , compact('errorPass'));
            }
        } else {
            $errorLog = 'Mauvaise adresse mail';
            $this->viewEmpty('auth/login' , compact('errorLog'));
        }
    }

    public function getUserByMail($mail) {
        $bdd = $this->db->getPDO();
        $condition = "SELECT * FROM user NATURAL JOIN `status`  WHERE user_mail = ? ";
        $result = $bdd->prepare($condition);
        $result->bindValue(1, $mail, \PDO::PARAM_STR);
        $result->execute();
        $fetch = $result->fetch(); /* pas fetchAll pour pas avoir 2 array */
        return $fetch;
    }

    public function getUserById($id) {
        $bdd = $this->db->getPDO();
        $condition = "SELECT * FROM user NATURAL JOIN `status` WHERE user_id = ?";
        $result = $bdd->prepare($condition);
        $result->bindValue(1, $id, \PDO::PARAM_INT);
        $result->execute();
        return $result->fetch();
    }


    public function logout()
    {
        session_unset();
        session_destroy();
        setcookie("user", "", time()-3600, '/');
        setcookie("id", "", time()-3600, '/');
        header('Location: /');
    }

   /*  protected static $instance;
    public $user;

    private function __construct() {
        $this->$user = unserialize($_SESSION['user']);
    }

    public static function getInstance() {
        if (! self::$instance) {
            self::$instance = new static;
        }
        return self::$instance;
    }

    public function __destruct() {
        $_SESSION["user"] = serialize($this->user);
    } */
}