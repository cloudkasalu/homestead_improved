<?php

namespace Ninja;

class Authentication{

    private $users;
    private $usernameColumn;
    private $passwordColumn;

    public function __construct( DatabaseTable $users, $usernameColumn, $passwordColumn){

        // include __DIR__ . '/../../includes/DatabaseConnection.php';

        session_start();
        $this->users = $users;
        $this->usernameColumn = $usernameColumn;
        $this->passwordColumn = $passwordColumn;
    }

    public function login($username, $password){

       $user = $this->users->find($this->usernameColumn, strtolower($username));

        if(!empty($user) && password_verify($password, $user[0][$this->passwordColumn])){
            session_regenerate_id();
            $_SESSION['username'] = $username;
            $_SESSION['password'] = $user[0][$this->passwordColumn];

            return true;
        } else{
            return false;
        }
    }
    public function isLoggedIn() {
        if (empty($_SESSION['username'])) {

        return false;
        }

        $user = $this->users->find($this->usernameColumn,strtolower($_SESSION['username']));

        if (!empty($user) &&
        $user[0][$this->passwordColumn] === $_SESSION['password']) {
        return true;
        } else {
        return false;
        }
     }

     public function logout(){

        unset($_SESSION['username']);
        unset($_SESSION['password']);
        session_regenerate_id();

		
	}

    public function getUser(){

        if($this->isLoggedIn()){
            $user = $this->users->find($this->usernameColumn, strtolower($_SESSION['username']))[0];
            return $user;
        }else{
            return false;
        }
    }

}