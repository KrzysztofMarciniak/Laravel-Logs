<?php

namespace App\Http\Middleware;

use Illuminate\Http\Request;

abstract class AbstractDataMine implements DataMineInterface
{
    /**
     * Merge collected data into the request.
     *
     * @param \Illuminate\Http\Request $request
     * @param string $key
     * @param mixed $value
     * @return void
     */
    protected function mergeIntoRequest(Request $request, string $key, $value)
    {
        $request->merge([$key => $value]);
    }
}

