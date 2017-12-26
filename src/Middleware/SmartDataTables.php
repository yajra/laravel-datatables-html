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

        $dataTable = app($request->smartDataTable);

        if ($request->ajax() && $request->wantsJson()) {
            return app()->call([$dataTable, 'ajax']);
        }

        if ($action = $dataTable->request()->get('action') and in_array($action, $dataTable->getActions())) {
            if ($action == 'print') {
                return app()->call([$dataTable, 'printPreview']);
            }

            return app()->call([$dataTable, $action]);
        }

        return $next($request);
    }
}
