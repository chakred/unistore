<?php

namespace App\Http\Middleware;

use App\Models\PageView;
use Closure;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Symfony\Component\HttpFoundation\Response;

class TrackPageView
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (! $request->session()->get('has_viewed_site')) {
            PageView::track();
            $request->session()->put('has_viewed_site', true);
        }

        Inertia::share('viewNumbers', PageView::current());

        return $next($request);
    }
}
