<?php

// app/Models/LinkClick.php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\Request;

class LinkClick extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'url', 'page_title','is_internal',
        'user_ip',
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($click) {
            $domain = parse_url(config('app.url'), PHP_URL_HOST);
            $click->is_internal = str_contains($click->url, $domain);
            $click->user_ip = Request::ip();
        });
    }
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
