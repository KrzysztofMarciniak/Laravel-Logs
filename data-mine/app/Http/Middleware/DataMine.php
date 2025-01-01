<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Models\DataMined;

class DataMine
{
    /**
     * List of data mine classes to call.
     *
     * @var array
     */
    protected $dataMineClasses = [
        DataMineIP::class,
        DataMineUserAgent::class,
        DataMineLanguage::class,
        DataMinePage::class,
        DataMineRequestMethod::class
    ];

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        foreach ($this->dataMineClasses as $dataMineClass) {
            (new $dataMineClass())->collect($request);
        }

        $data = [
            'ip_address'      => $request->get('ip_address'),
            'x-forwarded-for' => $request->get('x-forwarded-for'),
            'device_type'     => $request->get('user_agent')['device_type'],
            'os'              => $request->get('user_agent')['os'],
            'browser'         => $request->get('user_agent')['browser'],
            'browser_version' => $request->get('user_agent')['browser_version'],
            'device_model'    => $request->get('user_agent')['device_model'],
            'language'        => json_encode($request->get('user_languages')),
            'page'            => json_encode($request->get('url')),
            'request_method'  => $request->get('request_method'),
            'created_at'      => now(),
        ];

        DataMined::create($data);

        return $next($request);
    }
}

