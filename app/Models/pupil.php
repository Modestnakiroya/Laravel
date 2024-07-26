<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class pupil extends Model
{
    use HasFactory;
    protected $table = 'pupils';

    protected $fillable = [
        
        'firstNane',
        'lastName',
        'emailAddress',
        'dateOfBirth',
        'password',
        'school_registration_number',
        
    ];
}
