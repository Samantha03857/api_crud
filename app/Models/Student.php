<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Testing\Fluent\Concerns\Has;


class Student extends Model
{
    //
    use HasFactory;
    protected $table = 'student';
    protected $fillable = [
        'name',
        'email',
        'phone',
        'language'
    ];
}
