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
        DataMineIP::class
    ];

    public function handle(Request $request, Closure $next)
    {
        foreach ($this->dataMineClasses as $dataMineClass) {
            (new $dataMineClass())->collect($request);
        }

        $ipAddress = $request->get('ip_address');
        if ($ipAddress) {
            DataMined::create([
                'ip_address' => $ipAddress,
            ]);
        }

        return $next($request);
    }
}

