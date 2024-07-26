<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class adminstrator extends Model
{
    use HasFactory;
    protected $primaryKey = 'admnistratorId';
    protected $fillable = [
        'admnistratorId',
        'name',
        'emailAddress',
        'password',
    ];
}
