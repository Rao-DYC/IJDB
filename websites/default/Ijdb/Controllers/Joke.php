<?php

namespace Ijdb\Controllers;

use \Ninja\DatabaseTable;
use \Ninja\Authentication;

class Joke
{

    public function __construct(private DatabaseTable $joke_table, private DatabaseTable $author_table, private DatabaseTable $category_table, private Authentication $authentication)
    {
    }

    public function list()
    {
        $jokes = $this->joke_table->getAllJokes();
        $totalJokes = $this->joke_table->total();
        $user = $this->authentication->getUser();

        $title = 'Jokes List';

        return array(
            'title' => $title, 'template' => 'jokes.html.php',
            'variables' => [
                'totalJokes' => $totalJokes,
                'jokes' => $jokes,
                'user_id' => $user['id'] ?? null
            ]
        );
    }

    public function home()
    {
        $title = 'Internet joke database';
        return array('title' => $title, 'template' => 'home.html.php');
    }

    public function deleteSubmit()
    {
        $author = $this->authentication->getUser();
        $joke_data = $this->joke_table->find('id', $_POST['id'])[0];
        if ($joke_data['authorid'] != $author['id']) {
            return false;
        }
        $this->joke_table->delete($_POST['id']);
        header('location: /joke/list');
        exit;
    }

    public function editSubmit()
    {
        $author = $this->authentication->getUser();
        $joke_data = $this->joke_table->find('id', $_POST['joke']['id']);
        if (isset($joke_data[0]['authorid']) ) {
            if ($joke_data['authorid'] != $author['id']) {
                return false;
            }
        }
        $data = $_POST['joke'];
        $data['authorid'] = $author['id'];
 
        $this->joke_table->save($data);
        header('Location: /joke/list');
        exit;
    }
    public function edit($id = null)
    {
        $author = $this->authentication->getUser();

        if (isset($id) && !empty($id)) {
            $joke = $this->joke_table->find('id', $id)[0];
            $title = 'Update Joke';
        } else {
            $title = 'Add Joke';
            $joke = '';
        }
        return array(
            'title' => $title, 'template' => 'updateJoke.html.php',
            'variables' => [
                'joke' => $joke,
                'user_id' => $author['id'] ?? null,
                'categories' => $this->category_table->findAll()
            ]
        );
    }
}
 