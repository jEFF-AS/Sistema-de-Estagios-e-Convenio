<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Student extends Model
{
    use SoftDeletes;
    // Define a table que este modelo controla.
    protected $table = 'students';

    // Libera os campos para gravação em massa (Mass Assignment)
    protected $fillable = [
        'name',
        'registration_number',
        'course',
        'period',
        'course_start_date',
        'observations',
    ];

    // Garante que a data seja tratada como um objeto Carbon/Date nativo do PHP.
    protected $casts = [
        'course_start_date'=> 'date',
    ];
}
