<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\LinkClick;
use Illuminate\Support\Facades\Config;

class LinkClickSeeder extends Seeder
{
    public function run(): void
    {
        $domain = parse_url(Config::get('app.url'), PHP_URL_HOST);

        $links = [
            "https://{$domain}/dashboard",
            "https://{$domain}/profile",
            "https://laravel.com",
            "https://github.com",
            "https://filamentphp.com",
        ];

        foreach ($links as $url) {
            LinkClick::create(['url' => $url]);
        }
    }
}
