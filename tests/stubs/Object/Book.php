<?php

namespace bigpaulie\fractal\tests\stubs\Object;

/**
 * Class Book
 * @package bigpaulie\fractal\tests\stubs\Object
 */
class Book
{
    /**
     * @var string
     */
    private $title;

    /**
     * @var string
     */
    private $author;

    /**
     * Book constructor.
     * @param string $title
     * @param string $author
     */
    public function __construct($title, $author)
    {
        $this->title = $title;
        $this->author = $author;
    }

    /**
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * @return string
     */
    public function getAuthor()
    {
        return $this->author;
    }
}