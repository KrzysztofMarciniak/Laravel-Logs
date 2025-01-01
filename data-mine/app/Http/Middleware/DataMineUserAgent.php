<?php

namespace App\Http\Middleware;

use Jenssegers\Agent\Agent;
use Illuminate\Http\Request;

class DataMineUserAgent extends AbstractDataMine
{
    /**
     * Collect user agent information and merge it into the request.
     *
     * @param \Illuminate\Http\Request $request
     * @return void
     */
    public function collect(Request $request)
    {
        $userAgent = $request->header('User-Agent');
        if (!$userAgent) {
            return;
        }

        $agent = new Agent();
        $agent->setUserAgent($userAgent);
        $deviceType = $this->getDeviceType($agent);
        $os = $agent->platform();
        $browser = $agent->browser();
        $browserVersion = $agent->version($browser);
        $deviceModel = $agent->device();
        if (!$deviceModel){
            $deviceModel = null;
        }
        
        $this->mergeIntoRequest($request, 'user_agent', [
            'device_type'    => $deviceType,
            'os'             => $os,
            'browser'        => $browser,
            'browser_version'=> $browserVersion,
            'device_model'   => $deviceModel,
        ]);
    }

    /**
     * Get the device type (mobile, tablet, or desktop).
     *
     * @param \Jenssegers\Agent\Agent $agent
     * @return string
     */
    protected function getDeviceType(Agent $agent)
    {
        if ($agent->isMobile()) {
            return 'mobile';
        } elseif ($agent->isTablet()) {
            return 'tablet';
        } else {
            return 'desktop';
        }
    }
}

