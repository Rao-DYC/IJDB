<?php

namespace Ijdb\Controllers;

use \Ninja\Authentication;

class Login
{
    public function __construct(private Authentication $authentication)
    {
    }

    public function login()
    {
        return [
            'template' => 'loginform.html.php',
            'title' => 'Log In'
        ];
    }

    public function loginSubmit()
    {
        $success = $this->authentication->login($_POST['email'], $_POST['password']);

        if ($success) {
            return [
                'template' => 'loginSuccess.html.php',
                'title' => 'Login Successful'
            ];
        }
        return [
            'template' => 'loginform.html.php',
            'title' => 'Log In',
            'variables' => [
                'errorMessage' => true
            ]
        ];
    }

    public function logout()
    {
        $this->authentication->logout();
        header('location: /');
        exit();
    }
}
