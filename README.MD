# Fractal service provider for Laravel Framework 
[![Build Status](https://travis-ci.org/bigpaulie/fractal-laravel-service.svg?branch=master)](https://travis-ci.org/bigpaulie/fractal-laravel-service) [![Latest Stable Version](https://poser.pugx.org/bigpaulie/fractal-laravel-service/v/stable)](https://packagist.org/packages/bigpaulie/fractal-laravel-service) [![Total Downloads](https://poser.pugx.org/bigpaulie/fractal-laravel-service/downloads)](https://packagist.org/packages/bigpaulie/fractal-laravel-service) [![Latest Unstable Version](https://poser.pugx.org/bigpaulie/fractal-laravel-service/v/unstable)](https://packagist.org/packages/bigpaulie/fractal-laravel-service) 

This is a simple service provider for Laravel 5.x
## Installation
The preferred way to install the package is via composer
```
composer require bigpaulie/fractal-laravel-service
```

After installing the package you need to add the service provider to your config/app.php

``` 
bigpaulie\fractal\FractalServiceProvider::class
```

## Usage
First you need to create your transformers afterwards you can use the response helper with the corresponding macro

##### Collections
```
return response()->collection($collection, new YourTransformer());
```

##### Collections with pagination
```
return response()->collection($collection, new YourTransformer(), $collection);
```

##### Items
```
return response()->item($item, new YourTransformer());
```

##### Exceptions
```
return response()->exception($exception, new YourTransformer());
```

### Contribution
If you want to contribute to this project, please fork and submit a pull request.