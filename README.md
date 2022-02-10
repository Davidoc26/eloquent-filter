# Eloquent Filters

Simple filter system for building queries

## Requirements

- PHP 8.0+
- Laravel 8, 9

## Installation

```bash
composer require davidoc26/eloquent-filter
```

## Introduction

Filters allow you to apply restrictions/rules to create a query. It's like middlewares.

There are two types of filters:

1) Filter
2) RequestFilter (gives you access to the Request instance)

Filters can
also [have their own arguments (using HasArguments trait)](https://github.com/Davidoc26/eloquent-filter#filter-arguments)

## Usage

### Using Filterable

To start using filters, you need to use **Filterable** trait on your model.

```php
use Davidoc26\EloquentFilter\Traits\Filterable;

class Post extends Model
{
    use Filterable;
}
```

To define filters, override the **getFilters()** method in your model and return the filters. If no filters have been
defined, no filtering will be performed.

```php
public function getFilters(): array
{
    return [
        FirstFilter::class,
        SecondFilter::class => ['argument' => 20], // As mentioned above, filters can have their own arguments.
    ];
}
```

### Creating new filter

To create a basic filter use the command:

```php artisan make:filter MyFilter```

This command will create a filter inside app/Filters directory.

```php
use Davidoc26\EloquentFilter\Filters\Filter;

class MyFilter extends Filter
{
    public function filter(Builder $builder, Closure $next): Builder
    {
        //

        return $next($builder);
    }
}
```

### Creating new RequestFilter

If you need a filter that has a Request instance available, create a RequestFilter:

```php artisan make:request-filter MyRequestFilter```

```php
use Davidoc26\EloquentFilter\Filters\RequestFilter;

class MyRequestFilter extends RequestFilter
{
    public function filter(Builder $builder, Closure $next): Builder
    {
        // $this->request

        return $next($builder);
    }
}
```

### Filter arguments

If you want your filter to have arguments (for example default values) use the **HasArguments trait on your filter**.

To set the arguments, specify them in your model's **getFilters()** method:

```php
public function getFilters(): array
{
    return [
        LimitFilter::class => ['limit' => 10], // For convenience, specify the arguments in an array.
    ];
}
```

Then, you can get your arguments in your filter

```php
use Davidoc26\EloquentFilter\Filters\RequestFilter;
use Davidoc26\EloquentFilter\Traits\HasArguments;

class LimitFilter extends RequestFilter
{
    use HasArguments;

    public function filter(Builder $builder, Closure $next): Builder
    {
        $builder->when(
            $this->request->input('limit', $this->getArguments()['limit']),
            fn(Builder $builder, $limit) => $builder->limit($limit)
        );
        
        // Note that you must always return this.
        return $next($builder);
    }
}

```

## Filter Packs

Filter packs allows you to collect several filters in one pack. The main purpose of a filter pack is to apply the same
filters to models.

To create a filter pack use command:

```php artisan make:filter-pack MyFilterPack```

It will create filter pack in app/Filters/Packs directory:

```php 
<?php

namespace App\Filters\Packs;

use Davidoc26\EloquentFilter\Packs\FilterPack;

class MyFilterPack extends FilterPack
{
    public function getFilters(): array
    {
        return [
            // Define your filters here.
        ];
    }
}
```

Then you can apply filter pack to your model:

```php 
Post::withFilterPacks([MyFilterPack::class])->get();
// The meaning of the filter pack is that you can use it on any model that uses the Filterable trait
User::withFilterPacks([
    MyFilterPack::class, 
    SecondFilterPack::class,
])->get();
```

## Applying Filters

To apply the filters specified in the **getFilters()** method, use **filter()** on your model.

```php 
Post::filter()->get(); 
// You can also pass additional filters:
Post::filter([OrderByFilter::class])->get();
```

To use only the filters you need, use the withFilters() method and pass the required filters into it, **this method will
ignore the filters that were specified in your model**.

```php
Post::withFilters([
    LoadRelationshipFilter::class,
    OffsetFilter::class
])->get();
