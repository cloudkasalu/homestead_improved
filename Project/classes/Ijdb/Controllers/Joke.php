<?php

namespace Ijdb\Controllers;
use \Ninja\DatabaseTable;
use \Ninja\Authentication;


class Joke{

    private $authorsTable;
    private $jokesTable;
    private $authentication;

    public function __construct(DatabaseTable $jokesTable, DatabaseTable $authorsTable, Authentication $authentication){
        $this->jokesTable = $jokesTable;
        $this->authorsTable = $authorsTable;
        $this->authentication = $authentication;
    }

  


    public function list(){

        $result =$this->jokesTable->findAll();

        $jokes =[];

        foreach($result as $joke){

            $author = $this->authorsTable->findById($joke['authorid']);

            $jokes[] = [
                'id' => $joke['id'],
                'authorId' => $joke['authorid'],
                'joketext' => $joke['joketext'],
                'jokedate' => $joke['jokedate'],
                'name' => $author['name'],
                'email' => $author['email']
            ];
        }

        $title = 'Joke List';
        $totalJokes = $this->jokesTable->total();

        $author = $this->authentication->getUser();

        return ['template' =>'jokes.html.php', 'title'=>$title, 'variables'=>[
            'jokes'=> $jokes,
            'userId' => $author['id'] ?? null,
            'totalJokes'=> $totalJokes
        ]];
    }

    public function home(){

        $title = 'Internet Joke Database';

        return ['template' =>'home.html.php', 'title'=>$title];
    }

    public function delete() {
        $joke = $this->jokesTable->findById($_POST['id']);

        $author = $this->authentication->getUser();

        if($joke['authorid'] != $author['id']){
            return;
        }
        $this->jokesTable->delete($_POST['id']);
        header('location: /joke/list');
        }

    public function saveEdit(){

        $author = $this->authentication->getUser();


        if(isset($_GET['id'])){    
            $joke = $this->jokesTable->findById($_GET['id']);

            if($joke['authorid'] != $author['id']){
                return;
            }
    
        }

        $joke = $_POST['joke'];
        $joke['jokedate'] = new \DateTime();
        $joke['authorId'] = $author['id'];

        $this->jokesTable->save($joke);

        header('location: /joke/list');

    }

    public function edit(){

        $author = $this->authentication->getUser();

        if(isset($_GET['id'])){    
            $joke = $this->jokesTable->findById($_GET['id']);
    
        }
            
        $title = 'Edit joke';
    
        return ['template' =>'editjoke.html.php', 'title'=>$title, 'variables'=>[
            'joke'=> $joke ?? null,
            'userId' => $author['id'] ?? null
        ]];;



    }


}


