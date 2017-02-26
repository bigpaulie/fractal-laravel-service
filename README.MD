#Fractal service provider for Laravel Framework [![Build Status](https://travis-ci.org/bigpaulie/fractal-laravel-service.svg?branch=master)](https://travis-ci.org/bigpaulie/fractal-laravel-service)

This is a simple service provider for Laravel 5.x
## Installation
The preferred way to install the package is via composer
```
composer require --prefer-dist bipaulie/fractal-laravel-service
```

After installing the package you need to add the service provider to your config/app.php

``` 
bigpaulie\fractal\FractalServiceProvider::class
```

## Usage
First you need to create your transformers afterwards you can use the response helper with the corresponding macro

#####Collections
```
return response()->collection($collection, new YourTransformer());
```

#####Collections with pagination
```
return response()->collection($collection, new YourTransformer(), $collection);
```

#####Items
```
return response()->item($item, new YourTransformer());
```

### Contribution
If you want to contribute to this project, please fork and submit a pull request.