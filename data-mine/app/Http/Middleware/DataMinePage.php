<?php

namespace App\Http\Middleware;

use Illuminate\Http\Request;

class DataMinePage extends AbstractDataMine
{
    /**
     * Collect page URL and merge it into the request.
     *
     * @param \Illuminate\Http\Request $request
     * @return void
     */
    public function collect(Request $request)
    {
        $url = $request->url();
        $request->merge([
                'url' => $url,
        ]);
    }
}

