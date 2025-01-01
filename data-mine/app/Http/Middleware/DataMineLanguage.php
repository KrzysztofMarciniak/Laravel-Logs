<?php

namespace App\Http\Middleware;

use Jenssegers\Agent\Agent;
use Illuminate\Http\Request;

class DataMineLanguage extends AbstractDataMine
{
    /**
     * Collect language information and merge it into the request.
     *
     * @param \Illuminate\Http\Request $request
     * @return void
     */
    public function collect(Request $request)
    {
        $agent = new Agent();
        $languages = $agent->languages();
        $this->mergeIntoRequest($request, 'user_languages', $languages);
    }
}

