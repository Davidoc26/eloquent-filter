<?php

declare(strict_types=1);

namespace Davidoc26\EloquentFilter;

use Closure;
use Davidoc26\EloquentFilter\Exceptions\FilterInitializationException;
use Davidoc26\EloquentFilter\Filters\Filter;
use Davidoc26\EloquentFilter\Filters\RequestFilter;
use Davidoc26\EloquentFilter\Handlers\FilterHandler;
use Davidoc26\EloquentFilter\Handlers\RequestFilterHandler;
use Davidoc26\EloquentFilter\Parsers\ParsedFilter;
use Davidoc26\EloquentFilter\Parsers\ParsedFilterCollection;
use Illuminate\Container\Container;
use Illuminate\Contracts\Container\BindingResolutionException;
use Illuminate\Database\Eloquent\Builder;
use function array_reduce;
use function array_reverse;

/**
 * @psalm-suppress PropertyNotSetInConstructor
 */
final class Pipeline
{
    private Builder $builder;
    private Container $container;
    private ParsedFilterCollection $pipes;
    private FilterHandler $filterHandler;
    private RequestFilterHandler $requestFilterHandler;
    private bool $hasFilters = true;

    public function __construct(Container $container = null)
    {
        $this->container = $container ?: app();
        $this->filterHandler = new FilterHandler();
        $this->requestFilterHandler = new RequestFilterHandler();
    }

    /**
     * @param Builder $builder
     * @return $this
     */
    public function send(Builder $builder): self
    {
        $this->builder = $builder;

        return $this;
    }

    /**
     * @param ParsedFilterCollection $pipes
     * @return $this
     */
    public function through(ParsedFilterCollection $pipes): self
    {
        if ($pipes->isEmpty()) {
            $this->withoutFilters();
        }

        $this->pipes = $pipes;

        return $this;
    }

    /**
     * @param Closure $destination
     * @return mixed
     */
    public function then(Closure $destination): Builder
    {
        // if there are no any filters - immediately return builder
        if (!$this->hasFilters) {
            return ($this->prepareDestination($destination)($this->builder));
        }

        $pipeline = array_reduce(
            array_reverse($this->pipes->all()), $this->carry(), $this->prepareDestination($destination)
        );

        return $pipeline($this->builder);
    }

    /**
     * @return Builder
     */
    public function thenReturn(): Builder
    {
        return $this->then(function (Builder $passable): Builder {
            return $passable;
        });
    }

    /**
     * @param Closure $destination
     * @return Closure
     */
    protected function prepareDestination(Closure $destination): Closure
    {
        return static function (Builder $passable) use ($destination): Builder {
            return $destination($passable);
        };
    }

    /**
     * @return void
     */
    public function withoutFilters(): void
    {
        $this->hasFilters = false;
    }

    /**
     * @return Closure
     */
    protected function carry(): Closure
    {
        return function (Closure $stack, ParsedFilter $pipe): Closure {
            return function (Builder $passable) use ($stack, $pipe): Builder {
                $filter = $this->initFilter($pipe->name());

                return match (true) {
                    $filter instanceof Filter => $this->filterHandler->handle($filter, $passable, $stack, $pipe->getArguments()),
                    $filter instanceof RequestFilter => $this->requestFilterHandler->handle($filter, $passable, $stack, $pipe->getArguments()),
                };
            };
        };
    }

    /**
     * @param string $filterName
     * @return Filter|RequestFilter
     * @throws FilterInitializationException
     */
    protected function initFilter(string $filterName): Filter|RequestFilter
    {
        try {
            return $this->getContainer()->make($filterName);
        } catch (BindingResolutionException) {
            return throw new FilterInitializationException(sprintf("Cannot resolve filter \"%s\"", $filterName));
        }
    }

    /**
     * @return Container
     */
    protected function getContainer(): Container
    {
        return $this->container;
    }
}
