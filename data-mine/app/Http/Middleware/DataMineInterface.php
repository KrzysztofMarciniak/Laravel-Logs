<?php

namespace App\Http\Middleware;

interface DataMineInterface
{
    /**
     * Collect data from the request.
     *
     * @param \Illuminate\Http\Request $request
     * @return void
     */
    public function collect(\Illuminate\Http\Request $request);
}

