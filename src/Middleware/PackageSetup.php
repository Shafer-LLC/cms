<?php

namespace BinshopsBlog\Middleware;

use BinshopsBlog\Models\BinshopsConfiguration;
use Closure;

class PackageSetup
{
    public function handle($request, Closure $next)
    {
        $initial_setup = BinshopsConfiguration::get('INITIAL_SETUP');
        if (! $initial_setup) {
            return redirect(route('binshopsblog.admin.setup'));
        }

        return $next($request);
    }
}
