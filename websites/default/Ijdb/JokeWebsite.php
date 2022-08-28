<?php

namespace Ijdb;

use \Ninja\DatabaseTable;
use \Ninja\Authentication;
use \Ninja\Website;
use \Ijdb\Controllers\Author;
use \Ijdb\Controllers\Joke;
use Ijdb\Controllers\Login;
use Ijdb\Controllers\Category;

class JokeWebsite implements Website
{
    private DatabaseTable $joke_table;
    private DatabaseTable $author_table;
    private DatabaseTable $category_table;
    private Authentication $authentication;

    public function __construct()
    {
        $pdo = new \PDO('mysql:host=mysql;dbname=ijdb;charset=utf8mb4', 'ijdbuser', 'v.je');
        $pdo->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);

        $this->joke_table = new DatabaseTable($pdo, 'joke', 'id');
        $this->author_table = new DatabaseTable($pdo, 'authors', 'id');
        $this->category_table = new DatabaseTable($pdo, 'category', 'category_id');
        $this->authentication = new Authentication($this->author_table, 'email', 'password');
    }
    public function getDefaultRoute(): string
    {
        return 'joke/home';
    }

    public function getController(string $controller_name): ?object
    {

        if ($controller_name === 'joke') {
            $controller = new Joke($this->joke_table, $this->author_table, $this->category_table, $this->authentication);
        } elseif ($controller_name === 'author') {
            $controller = new Author($this->author_table);
        } elseif ($controller_name == 'category') {
            $controller = new Category($this->category_table);
        } elseif ($controller_name === 'login') {
            $controller = new Login($this->authentication);
        } else {
            $controller = null;
        }

        return $controller;
    }

    public function checkLogin(string $uri): ?string
    {
        $restricted_pages = ['joke/edit', 'joke/delete', 'category/edit', 'category/delete'];
        if (in_array($uri, $restricted_pages) && !$this->authentication->isLoggedIn()) {
            header('location: /login/login');
            exit();
        }
        return $uri;
    }

    public function getLayoutVariables(): array
    {
        return ['is_logged_in' => $this->authentication->isLoggedIn()];
    }
}
