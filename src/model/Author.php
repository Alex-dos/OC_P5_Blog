<?php

namespace App\Model;

class Author
{
    private $id;
    private $author;

    /**
     * Get the value of id.
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set the value of id.
     *
     * @return self
     */
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    /**
     * Get the value of author.
     */
    public function getAuthor()
    {
        return $this->author;
    }

    /**
     * Set the value of author.
     *
     * @return self
     */
    public function setAuthor(string $author)
    {
        $this->author = $author;

        return $this;
    }
}
