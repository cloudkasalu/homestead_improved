<?php

namespace Ijdb\Controllers;

class Login{

    private $authentication;

    public function __construct(\Ninja\Authentication $authentication ){

        $this->authentication = $authentication;

    }

    public function error(){
        $title = "Error";

        return ['template'=> 'loginerror.html.php', 'title'=>$title];
    }

    public function loginForm(){

        $title = "Login";

        return['template'=> 'login.html.php', 'title'=>$title];
    }

    public function loginProcess(){
        $email = $_POST['email'];
        $password = $_POST['password'];

        if($this->authentication->login($email,$password)){
            header('location: /');
        }else{

            return['template'=> 'login.html.php', 'title'=>$title, 'variables'=>[ 'error'=> 'Invalid Email/Password']];
        }
    }

    public function logout(){

        $this->authentication->logout();
        header('location:/');
    }
}