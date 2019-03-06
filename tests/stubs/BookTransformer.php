<?php

namespace bigpaulie\fractal\tests\stubs;


use bigpaulie\fractal\tests\stubs\Object\Book;
use League\Fractal\TransformerAbstract;

/**
 * Class BookTransformer
 * @package bigpaulie\fractal\tests\stubs
 */
class BookTransformer extends TransformerAbstract
{
    /**
     * @param Book $book
     * @return array
     */
    public function transform(Book $book)
    {
        return [
            'title' => $book->getTitle(),
            'author' => $book->getAuthor(),
        ];
    }
}