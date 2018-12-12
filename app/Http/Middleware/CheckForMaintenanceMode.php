<?php

namespace App\Http\Middleware;

use Closure;
use App\Model\Admin\Site;

use Symfony\Component\HttpKernel\Exception\HttpException;

class CheckForMaintenanceMode
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
            $site = Site::all();
          
        if(app()->isDownForMaintenance() || $site[0]['status'] == 0){
 
 if(!$request->is('admin*')){
            throw new HttpException(503);
}

    }
        return $next($request);
        
    }
}
