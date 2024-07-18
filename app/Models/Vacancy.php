<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vacancy extends Model
{
    use HasFactory;

    // Define the table if it's not the plural of the model name
    protected $table = 'vacancies'; // Adjust if necessary

    // Define the fillable properties
    protected $fillable = [
        'title',
        'subtitle',
        'description',
        'employment_type',
    ];
}
