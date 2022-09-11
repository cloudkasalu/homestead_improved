<?php

namespace Ijdb\Controllers;

use \Ninja\DatabaseTable;

class Register{

    private $authorsTable;

    public function __construct(Databasetable $authorsTable){
        $this->authorsTable = $authorsTable;
    }

    public function registrationForm(){



        return['template'=>'register.html.php', 'title'=>'Register An Account'];

    }

    public function success(){

    return ['template' => 'registersuccess.html.php',
    'title' => 'Registration Successful'];
    }

    public function registerUser() {
        $author = $_POST['author'];

        $valid = true;
        $errors = [];

        if(empty($author['name'])){
            $valid = false;
            $errors[]= 'Name Cannot Be Blank';
        }

        if(empty($author['email'])){
            $valid = false;
            $errors[]= 'Email Cannot Be Blank';
        }elseif (filter_var($author['email'], FILTER_VALIDATE_EMAIL) == false) {
            $valid = false;
            $errors[] = 'Invalid email address';
         }else{
            $author['email'] = strtolower($author['email']);

         }
        if (count($this->authorsTable->find('email', $author['email']))
        > 0) {
        $valid = false;
        $errors[] = 'That email address is already registered';
        }
            
            

        if(empty($author['password'])){
            $valid = false;
            $errors[]= 'Password Cannot Be Blank';
        }

        if($valid == true){

            $author['password'] = password_hash($author['password'],PASSWORD_DEFAULT);

            $this->authorsTable->save($author);
            header('Location: /user/success');  

        } else{

            return['template'=>'register.html.php', 'authentication'=>true, 'title'=>'Register An Account','variables'=>[
                'errors'=> $errors,
                'author'=> $author
            ]];
        }

       }

}
