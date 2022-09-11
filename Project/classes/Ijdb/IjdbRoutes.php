<?php

namespace Ijdb;

class IjdbRoutes implements \Ninja\Routes{

    private $authorsTable;
    private $jokesTable;
    private $authentication;


    public function __construct(){

        include __DIR__ . '/../../includes/DatabaseConnection.php';

        $this->authorsTable = new \Ninja\DatabaseTable($pdo, 'author','id');
        $this->jokesTable = new \Ninja\DatabaseTable($pdo, 'joke', 'id');
        $this->authentication = new \Ninja\Authentication($this->authorsTable, 'email', 'password');

    }

    public function getRoutes():array{

    $jokeController = new \Ijdb\Controllers\Joke($this->jokesTable,$this->authorsTable, $this->authentication);
    $authorController = new \Ijdb\Controllers\Register($this->authorsTable);
    $loginController = new \Ijdb\Controllers\Login($this->authentication);
    $routes = [

    'user/register' => [
    'POST' => [
    'controller' => $authorController,
    'action' => 'registerUser'
    ],
    'GET' => [
        'controller' => $authorController,
        'action' => 'registrationForm'
        ]
    ],
    'user/success' => [
    'GET' => [
    'controller' => $authorController,
    'action' => 'success'
    ]
    ],
    'joke/edit' => [
    'POST' => [
    'controller' => $jokeController,
    'action' => 'saveEdit'
    ],
    'GET' => [
    'controller' => $jokeController,
    'action' => 'edit'
    ],
    'login' => true
    ],
    'joke/delete' => [
    'POST' => [
    'controller' => $jokeController,
    'action' => 'delete'
    ]
    ],
    'joke/list' => [
    'GET' => [
    'controller' => $jokeController,
    'action' => 'list'
    ],
    'login' => true
    ],
    '' => [
    'GET' => [
    'controller' => $jokeController,
    'action' => 'home'
    ]
    ],
    'login' => [
        'GET' => [
            'controller' => $loginController,
            'action' => 'loginForm'
        ],
        'POST' =>[
            'controller' => $loginController,
            'action' => 'loginProcess'
        ]
        ],

    'logout' => [
        'GET' => [
            'controller' => $loginController,
            'action' => 'logout'
        ]
        ]
    ];
    return $routes;
    }

    public function getAuthentication():\Ninja\Authentication{
        return $this->authentication;
    }


}




