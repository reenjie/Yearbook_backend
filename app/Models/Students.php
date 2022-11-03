<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Students extends Model
{
    use HasFactory;

    protected $fillable = [
        'Firstname',
        'Lastname',
        'Email',
        'Contact',
        'Batch_ID',
        'Section_ID',
        'Honors',
        'photo',
    ];
}
