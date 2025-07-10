<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Jenssegers\Agent\Agent;

class Session extends Model
{

    public $incrementing = false;

    protected $table = 'sessions';
    protected $fillable = [
        'user_id',
        'ip_address',
        'user_agent',
        'payload',
        'last_activity',
    ];

    protected $hidden = [
        'payload'
    ];

    public function getLastActivityAttribute($value): string
    {
        return Carbon::createFromTimestamp($value)->diffForHumans();
    }

    public function getUserAgentAttribute($value): array

    {
        $agent = new Agent();
        $agent->setUserAgent($value);

        return [
            'platform' => $agent->platform(),
            'browser' => $agent->browser(),
            'is_desktop' => $agent->isDesktop(),
        ];
    }

    public function getIsThisDeviceAttribute()
    {
        return $this->id == request()->session()->getId();
    }

    protected $appends = [
        'is_this_device',
    ];
}
