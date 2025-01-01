<?php

namespace App\Http\Middleware;

use Illuminate\Http\Request;

class DataMineRequestMethod extends AbstractDataMine
{
    public function collect(Request $request)
    {
        $method = $request->method();

        $this->mergeIntoRequest($request, 'request_method', $method);
    }
}

