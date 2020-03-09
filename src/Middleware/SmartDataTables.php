<?php

namespace Yajra\DataTables\Html\Middleware;

use Closure;

class SmartDataTables
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * 
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (!$request->has('smartDataTable')) {
            return $next($request);
        }

        $dataTable = app($request->get('smartDataTable'));

        if ($response = $dataTable->render()) {
        	return $response;
        }

        return $next($request);
    }
}
