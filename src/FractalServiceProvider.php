<?php

namespace bigpaulie\fractal;

use Illuminate\Support\ServiceProvider;
use League\Fractal\Manager;
use League\Fractal\TransformerAbstract;
use League\Fractal\Resource\Item;
use League\Fractal\Resource\Collection;
use League\Fractal\Pagination\IlluminatePaginatorAdapter;
use bigpaulie\fractal\serializers\ApiSerializer;

class FractalServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        // get an instance of Manager
        $fractal = $this->app->make('\League\Fractal\Manager');

        // setup response for item
        response()->macro('item', function ($item, TransformerAbstract $transformer, $status = 200, array $headers = []) use ($fractal) {

            $resource = new Item($item, $transformer);
            return response()->json(
                $fractal->createData($resource)->toArray(),
                $status,
                $headers
            );

        });

        // setup response for collection
        response()->macro('collection', function ($collection, TransformerAbstract $transformer, $paginator = null, $status = 200, array $headers = []) use ($fractal) {

            $resource = new Collection($collection, $transformer);
            if ( $paginator )
                $resource->setPaginator( new IlluminatePaginatorAdapter($paginator) );

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
        $this->app->bind('\League\Fractal\Manager', function ($app) {

            /**
             * Get an instance of \Illuminate\Http\Request
             * and pass it to the Manager
             */
            $request = $app->make('\Illuminate\Http\Request');

            $manager = new Manager();
            $manager->setSerializer(new ApiSerializer());
            $manager->parseIncludes($request->get('include',''));
            return $manager;
        });
    }
}
