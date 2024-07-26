<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class representative extends Model
{
    use HasFactory;
    protected $table = 'representatives';

    protected $fillable = [
        
        'username',
        'emailAddress',
        'school_registration_number',
        'password'
        
        
    ];
    

}