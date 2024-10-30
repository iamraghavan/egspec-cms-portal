<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NewspaperCutout extends Model
{
    use HasFactory;

    // Specify the table associated with the model
    protected $table = 'newspaper_cutouts';

    // Define the fillable fields
    protected $fillable = [
        'newspaper_name',
        'description',
        'date_of_publish',
        'image_path',
        'department',
        'uploaded_by',
    ];

    // Define the relationship with the User model (assuming the user model is User)
    public function user()
    {
        return $this->belongsTo(User::class, 'uploaded_by');
    }

    // Optionally, you can define timestamps if your table uses them
    public $timestamps = true;
}