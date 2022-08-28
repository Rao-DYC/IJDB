<?php

namespace Ijdb\Controllers;

use \Ninja\DatabaseTable;

class Category
{
    public function __construct(private DatabaseTable $category_table)
    {
    }

    public function edit(?string $id = null): array
    {
        if (isset($id) && !empty($id)) {
            $category = $this->category_table->find('category_id', $id)[0];
        }

        return [
            'template' => 'edit_category.html.php',
            'title' => 'Edit Category',
            'variables' => [
                'category' => $category ?? null
            ]
        ];
    }

    public function editSubmit()
    {
        $category = $_POST['category'];
        $this->category_table->save($category);
        header("Location: /category/list");
        exit();
    }

    public function list()
    {
        return [
            'template' => 'categories.html.php',
            'title' => 'Joke categories',
            'variables' => [
                'categories' => $this->category_table->findAll()
            ]
        ];
    }

    public function deleteSubmit()
    {
        $this->category_table->delete($_POST['category_id']);
        header("Location: /category/list");
        exit();
    }
}
