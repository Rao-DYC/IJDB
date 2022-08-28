<?php

namespace Ninja;

class EntryPoint
{
    public function __construct(private \Ninja\website $website)
    {
    }
    private function loadTemplate($file, $variables)
    {
        extract($variables);
        ob_start();
        include __DIR__ . '/../templates/' . $file;
        return ob_get_clean();
    }

    private function checkUri($uri)
    {
        if ($uri != strtolower($uri)) {
            http_response_code(301);
            header('Location: /' . strtolower($uri));
            exit;
        }
    }

    public function run(string $uri)
    {
        try {
            $this->checkUri($uri);

            if ($uri == '') {
                $uri = $this->website->getDefaultRoute();
            }
            $route = explode('/', $uri);

            $controller_name = array_shift($route);
            $action = array_shift($route);

            $this->website->checkLogin($controller_name . '/' . $action);

            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                $action .= 'Submit';
            }
            $controller = $this->website->getController($controller_name);

            if (is_callable([$controller, $action])) {
                $page = $controller->$action(...$route);
                $title = $page['title'];
                $variables = $page['variables'] ?? [];
                $output = $this->loadTemplate($page['template'], $variables);
            } else {
                http_response_code(404);
                $title = 'Not Found';
                $output = '<h1>Page Not Found</h1>';
            }
        } catch (\Exception $e) {
            $title = 'An Error Occured';
            $output = 'Error Message: ' . $e->getMessage() . '<br/> In file: ' . $e->getFile() . '<br/> On this line: ' . $e->getLine();
        }
        $layout_variables = $this->website->getLayoutVariables();
        $layout_variables['title'] = $title;
        $layout_variables['output'] = $output;
        echo $this->loadTemplate('layout.html.php', $layout_variables);
    }
}
