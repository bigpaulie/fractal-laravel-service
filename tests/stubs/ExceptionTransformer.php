<?php

namespace bigpaulie\fractal\tests\stubs;


use League\Fractal\TransformerAbstract;

/**
 * Class ExceptionTransformer
 * @package bigpaulie\fractal\tests\stubs
 */
class ExceptionTransformer extends TransformerAbstract
{
    /**
     * @param \Exception $exception
     * @return array
     */
    public function transform(\Exception $exception)
    {
        return [
            'message' => $exception->getMessage()
        ];
    }
}