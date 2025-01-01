<?php

namespace App\Http\Middleware;

use Illuminate\Http\Request;

class DataMineIP extends AbstractDataMine
{
    /**
     * Collect IP-related data for the request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return void
     */
    public function collect(Request $request)
    {
        $xForwardedFor = $request->header('X-Forwarded-For');
        
        $clientIp = $this->getClientIpFromXForwardedFor($xForwardedFor);

        $ipAddress = $clientIp ?: $request->ip();

        $this->mergeIntoRequest($request, 'x_forwarded_for', $xForwardedFor);
        $this->mergeIntoRequest($request, 'ip_address', $ipAddress);
    }

    /**
     * Extract the client IP from the X-Forwarded-For header.
     *
     * @param  string|null  $xForwardedFor
     * @return string|null
     */
    protected function getClientIpFromXForwardedFor($xForwardedFor)
    {
        if (!$xForwardedFor) {
            return null;
        }

        $ipList = explode(',', $xForwardedFor);

        foreach ($ipList as $ip) {
            $ip = trim($ip);
            if ($this->isValidIp($ip)) {
                return $ip;
            }
        }

        return null;
    }

    /**
     * Validate if the given string is a valid IP address.
     *
     * @param  string  $ip
     * @return bool
     */
    protected function isValidIp($ip)
    {
        return filter_var($ip, FILTER_VALIDATE_IP) !== false;
    }
}

