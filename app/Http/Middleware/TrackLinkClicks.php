<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Models\LinkClick;
use Illuminate\Support\Facades\Auth;

class TrackLinkClicks
{
    public function handle(Request $request, Closure $next)
    {
        $response = $next($request);

        if (Auth::check() && $request->isMethod('get') && ! $request->is('link-history')) {
            LinkClick::create([
                'user_id' => Auth::id(),
                'url' => $request->fullUrl(),
                'page_title' => optional($response->original)['title'] ?? $request->path(),
            ]);
        }

        return $response;
    }
}
