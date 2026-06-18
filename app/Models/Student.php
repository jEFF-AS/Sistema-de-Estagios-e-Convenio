<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    // Define a table que este modelo controla.
    protected $table = 'students';

    // Libera os campos para gravação em massa (Mass Assignment)
    protected $fillable = [
        'name',
        'registration_number',
        'course',
        'period',
        'course_start_date',
    ];

    // Garante que a data seja tratada como um objeto Carbon/Date nativo do PHP.
    protected $casts = [
        'course_start_date'=> 'date',
    ];
}
