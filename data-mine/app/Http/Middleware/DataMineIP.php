<?php

namespace App\Http\Middleware;

use Illuminate\Http\Request;

class DataMineIP extends AbstractDataMine
{
    public function collect(Request $request)
    {
        $ipAddress = $request->header('X-Forwarded-For') ?? $request->ip();
        $this->mergeIntoRequest($request, 'ip_address', $ipAddress);
    }
}

