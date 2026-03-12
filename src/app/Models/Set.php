<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Set extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'theme',
        'year',
        'num_parts',
        'image_url'
    ];
}