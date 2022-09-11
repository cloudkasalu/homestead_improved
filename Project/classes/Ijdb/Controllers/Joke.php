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
                'joketext' => $joke['joketext'],
                'jokedate' => $joke['jokedate'],
                'name' => $author['name'],
                'email' => $author['email']
            ];
        }

        $title = 'Joke List';
        $totalJokes = $this->jokesTable->total();



        return ['template' =>'jokes.html.php', 'title'=>$title, 'variables'=>[
            'jokes'=> $jokes,
            'totalJokes'=> $totalJokes
        ]];
    }

    public function home(){

        $title = 'Internet Joke Database';

        return ['template' =>'home.html.php', 'title'=>$title];
    }

    public function delete() {
        $this->jokesTable->delete($_POST['id']);
        header('location: /joke/list');
        }

    public function saveEdit(){

        $author = $this->authentication->getUser();

        $joke = $_POST['joke'];
        $joke['jokedate'] = new \DateTime();
        $joke['authorId'] = $author['id'];

        $this->jokesTable->save($joke);

        header('location: /joke/list');

    }

    public function edit(){


        if(isset($_GET['id'])){    
            $joke = $this->jokesTable->findById($_GET['id']);
    
        }
            
        $title = 'Edit joke';
    
        return ['template' =>'editjoke.html.php', 'title'=>$title, 'variables'=>[
            'joke'=> $joke ?? null
        ]];;



    }
}


