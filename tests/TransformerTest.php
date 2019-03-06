<?php

namespace bigpaulie\fractal\tests;


use bigpaulie\fractal\Serializer\ApiSerializer;
use bigpaulie\fractal\tests\stubs\BookTransformer;
use bigpaulie\fractal\tests\stubs\ExceptionTransformer;
use bigpaulie\fractal\tests\stubs\Object\Book;
use League\Fractal\Manager;
use League\Fractal\Resource\Collection;
use League\Fractal\Resource\ExceptionResource;
use League\Fractal\Resource\Item;
use PHPUnit\Framework\TestCase;

/**
 * Class TransformerTest
 * @package bigpaulie\fractal\tests
 */
class TransformerTest extends TestCase
{
    /**
     * @var Manager
     */
    private $manager;

    /**
     * Setup
     */
    public function setUp()
    {
        $this->manager = new Manager();
        $this->manager->setSerializer(new ApiSerializer());
    }

    /**
     * Test exception resource transformer
     */
    public function testExceptionTransformer()
    {
        /** @var \Exception $exception */
        $exception = new \Exception('this is an exception');

        /** @var ExceptionResource $resource */
        $resource = new ExceptionResource($exception, new ExceptionTransformer());

        /** @var array $data */
        $data = $this->manager->createData($resource)->toArray();

        $this->assertEquals([
            'success' => false,
            'data' => [
                'message' => 'this is an exception'
            ]
        ], $data);
    }


    /**
     * Test item resource transformer
     */
    public function testBookTransformer()
    {
        /** @var Book $book */
        $book = new Book('Title', 'Author');

        /** @var Item $resource */
        $resource = new Item($book, new BookTransformer());

        /** @var array $data */
        $data = $this->manager->createData($resource)->toArray();

        $this->assertEquals([
            'success' => true,
            'data' => [
                'title' => 'Title',
                'author' => 'Author'
            ]
        ], $data);
    }

    /**
     * Test collection resource transformer
     */
    public function testBooksTransformer()
    {
        /** @var Book[] $books */
        $books = [
            new Book('Title', 'Author'),
            new Book('Title', 'Author'),
            new Book('Title', 'Author'),
        ];

        /** @var Item $resource */
        $resource = new Collection($books, new BookTransformer());

        /** @var array $data */
        $data = $this->manager->createData($resource)->toArray();

        $this->assertEquals([
            'success' => true,
            'data' => [
                [
                    'title' => 'Title',
                    'author' => 'Author'
                ],
                [
                    'title' => 'Title',
                    'author' => 'Author'
                ],
                [
                    'title' => 'Title',
                    'author' => 'Author'
                ]
            ]
        ], $data);
    }

    /**
     * Teardown the test
     */
    public function tearDown()
    {
        $this->manager = null;
    }
}