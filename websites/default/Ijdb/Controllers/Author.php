<?php

namespace Ijdb\Controllers;

use \Ninja\DatabaseTable;

class Author
{

    public function __construct(private DatabaseTable $author_table)
    {
    }

    public function registrationForm()
    {
        return array('template' => 'register.html.php', 'title' => 'Register An account');
    }

    public function success()
    {
        return array('template' => 'registrationsuccess.html.php', 'title' => 'Registration Successful');
    }

    public function registrationFormSubmit()
    {
        $author_data = $_POST['author'];
        $errors = [];

        if (!isset($author_data['name']) || empty($author_data['name'])) {
            $errors[] = 'Name Cannot be blank';
        }

        if (!isset($author_data['email']) || empty($author_data['email'])) {
            $errors[] = 'Email Cannot be blank';
        } elseif (isset($author_data['email']) && filter_var($author_data['email'], FILTER_VALIDATE_EMAIL) == false) {
            $errors[] = 'Not a valid email';
        } else {
            $author_data['email'] = strtolower($author_data['email']);
            if (count($this->author_table->find('email', $author_data['email'])) > 0) {
                $errors[] = 'Email already registered';
            }
        }

        if (!isset($author_data['password']) || empty($author_data['password'])) {
            $errors[] = 'Password Cannot be blank';
        }
        if (empty($errors)) {
            $author_data['password'] = password_hash($author_data['password'], PASSWORD_DEFAULT);
            $this->author_table->save($author_data);
            header('Location: /author/success');
        } else {
            return array(
                'template' => 'register.html.php', 'title' => 'Register an account',
                'variables' => [
                    'errors' => $errors, 'author' => $author_data
                ]
            );
        }
    }
}
