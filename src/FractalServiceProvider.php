<?php

namespace bigpaulie\fractal;

use Illuminate\Http\Request;
use Illuminate\Support\ServiceProvider;
use League\Fractal\Manager;
use League\Fractal\Resource\ExceptionResource;
use League\Fractal\TransformerAbstract;
use League\Fractal\Resource\Item;
use League\Fractal\Resource\Collection;
use League\Fractal\Pagination\IlluminatePaginatorAdapter;
use bigpaulie\fractal\Serializer\ApiSerializer;

/**
 * Class FractalServiceProvider
 * @package bigpaulie\fractal
 */
class FractalServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     * @throws \Illuminate\Contracts\Container\BindingResolutionException
     */
    public function boot()
    {
        /** @var Manager $fractal */
        $fractal = $this->app->make(Manager::class);

        /**
         * Register a macro for item response
         */
        response()->macro('item', function ($item, TransformerAbstract $transformer, $status = 200, array $headers = []) use ($fractal) {
            /** @var Item $resource */
            $resource = new Item($item, $transformer);
            return response()->json(
                $fractal->createData($resource)->toArray(),
                $status,
                $headers
            );
        });

        /**
         * Register a macro fro collection response
         */
        response()->macro('collection', function ($collection, TransformerAbstract $transformer, $paginator = null, $status = 200, array $headers = []) use ($fractal) {
            /** @var Collection $resource */
            $resource = new Collection($collection, $transformer);
            if ( $paginator )
                $resource->setPaginator( new IlluminatePaginatorAdapter($paginator) );

            return response()->json(
                $fractal->createData($resource)->toArray(),
                $status,
                $headers
            );
        });

        /**
         * Register a macro for exception response
         */
        response()->macro('exception', function ($exception, TransformerAbstract $transformer, $status = 500, array $headers = []) use ($fractal) {
            /** @var ExceptionResource $resource */
            $resource = new ExceptionResource($exception, $transformer);
            return response()->json(
                $fractal->createData($resource)->toArray(),
                $status,
                $headers
            );
        });
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(Manager::class, function ($app) {

            /**
             * Get an instance of \Illuminate\Http\Request
             * and pass it to the Manager
             */
            $request = $app->make(Request::class);

            $manager = new Manager();
            $manager->setSerializer(new ApiSerializer());
            $manager->parseIncludes($request->get('include',''));
            return $manager;
        });
    }
}
