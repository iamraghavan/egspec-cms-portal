<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LiveEvent extends Model
{
    use HasFactory;

    protected $table = 'live_events';

    protected $fillable = [
        'title',
        'date',
        'time',
        'venue',
        'attachment',
        'event_image',
        'slug',
        'event_created_by',
        'event_url',
        'department',
        'event_id'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'event_created_by');
    }
}
