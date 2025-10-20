<?php

namespace App\Http\Controllers;

use App\Models\LinkClick;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LinkRedirectController extends Controller
{
    public function redirect(Request $request)
    {
        $targetUrl = $request->query('url');

        if (! $targetUrl) {
            abort(400, 'Missing URL parameter');
        }

        if (! filter_var($targetUrl, FILTER_VALIDATE_URL)) {
            abort(400, 'Invalid URL');
        }

        // Record link click if authenticated
        if (Auth::check()) {
            LinkClick::create([
                'user_id' => Auth::id(),
                'url' => $targetUrl,
                'page_title' => parse_url($targetUrl, PHP_URL_HOST),
            ]);
        }

        // Redirect to the actual link
        return redirect()->away($targetUrl);
    }
}


// app/Http/Controllers/LinkRedirectController.php
// namespace App\Http\Controllers;

// use App\Models\LinkClick;
// use Illuminate\Http\Request;
// use Illuminate\Support\Facades\Auth;

// class LinkRedirectController extends Controller
// {

//     public function redirect(Request $request)
//     {
//         $targetUrl = $request->query('url');

//         if (! $targetUrl) {
//             abort(400, 'Missing URL parameter');
//         }

//         // Optional: sanitize URLs
//         if (! filter_var($targetUrl, FILTER_VALIDATE_URL)) {
//             abort(400, 'Invalid URL');
//         }

//         // Save the click
//         LinkClick::create([
//             'user_id' => Auth::id(),
//             'url' => $targetUrl,
//             'page_title' => parse_url($targetUrl, PHP_URL_HOST),
//         ]);

//         // Redirect user to real destination
//         return redirect()->away($targetUrl);
//     }
//     public function redirect(Request $request)
//     {
//         $targetUrl = $request->query('url');

//         // 1. Validate the URL
//         if (! $targetUrl) {
//             abort(400, 'Missing URL parameter');
//         }

//         if (! filter_var($targetUrl, FILTER_VALIDATE_URL)) {
//             abort(400, 'Invalid URL provided');
//         }

//         // 2. Save the click
//         if (Auth::check()) {
//             LinkClick::create([
//                 'user_id' => Auth::id(),
//                 'url' => $targetUrl,
//                 'page_title' => parse_url($targetUrl, PHP_URL_HOST), // Use domain as a simple title
//             ]);
//         }




//         // 3. Redirect user to the real destination
//         return redirect()->away($targetUrl);
//     }
// }
