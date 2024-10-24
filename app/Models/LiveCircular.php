<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LiveCircular extends Model
{
    use HasFactory;
    protected $table = 'live_circulars';
    protected $fillable = [
        'title',
        'circular_content',
        'date',
        'circular_attachment',
        'slug',
        'circular_created_by',
        'department',
        'circular_id',
        'authorized_signature_person',
    ];

    // Define the relationship with the User model
    public function user()
    {
        return $this->belongsTo(User::class, 'circular_created_by');
    }
}