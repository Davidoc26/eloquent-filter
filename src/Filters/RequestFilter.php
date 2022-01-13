<?php

declare(strict_types=1);

namespace Davidoc26\EloquentFilter\Filters;

use Illuminate\Http\Request;

abstract class RequestFilter implements FilterInterface
{
    protected Request $request;

    public function setRequest(Request $request): void
    {
        $this->request = $request;
    }
}
