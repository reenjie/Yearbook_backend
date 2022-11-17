<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Instructor extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'Firstname',
        'Middlename',
        'Lastname',
        'Contact',
        'FK_user_ID',
        'FK_section_ID',
    ];
    
    /**
     * Get the user that owns the Students
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'FK_user_ID');
    }
}
