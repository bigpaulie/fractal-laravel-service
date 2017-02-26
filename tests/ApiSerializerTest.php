<?php

use PHPUnit\Framework\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use bigpaulie\fractal\serializers\ApiSerializer;

class ApiSerializerTest extends TestCase
{
    /**
     * Instance of ApiSerializer
     * @var ApiSerializer $serializer
     */
    private $serializer;

    /**
     * Setup test
     */
    public function setUp()
    {
        $this->serializer = new ApiSerializer();
    }

    /**
     * Test collection
     */
    public function testCollection()
    {
        $this->assertEquals([
            'success' => true,
            'data' => [
                'name' => 'John Doe',
                'email' => 'john.doe@doe.com'
            ]
        ], $this->getSerializedCollection());
    }

    /**
     * Test item
     */
    public function testItem()
    {
        $this->assertEquals([
            'success' => true,
            'data' => [
                'name' => 'IT'
            ]
        ], $this->getSerializedItem());
    }

    /**
     * Test merging collections with items
     */
    public function testMergeIncludes()
    {
        $this->assertEquals([
            'name' => 'John Doe',
            'email' => 'john.doe@doe.com',
            'department' => [
                'name' => 'IT'
            ]
        ], $this->serializer->mergeIncludes(
            $this->getTestCollection(),
            ['department' => $this->getSerializedItem()]
        ));
    }

    /**
     * A test collection
     * @return array
     */
    public function getTestCollection()
    {
        return [
            'name' => 'John Doe',
            'email' => 'john.doe@doe.com'
        ];
    }

    /**
     * A test item
     * @return array
     */
    public function getTestItem()
    {
        return [
            'name' => 'IT',
        ];
    }

    /**
     * A serialized collection
     * @return array
     */
    public function getSerializedCollection()
    {
        return $this->serializer->collection('person', $this->getTestCollection());
    }

    /**
     * A serialized item
     * @return array
     */
    public function getSerializedItem()
    {
        return $this->serializer->item('department', $this->getTestItem());
    }
}
