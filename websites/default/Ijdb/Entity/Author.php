<?php

namespace Ijdb\Entity;

use \Ninja\DatabaseTable;

class Author
{
    public function __construct(private DatabaseTable $jokeTable)
    {
    }

    public function getJokes()
    {
        return $this->jokeTable->find('authorid', $this->id);
    }
}
