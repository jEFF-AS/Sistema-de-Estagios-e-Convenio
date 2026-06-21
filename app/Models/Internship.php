<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Internship extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'student_id',
        'company_id',
        'type',
        'modality',
        'start_date',
        'estimated_end_date',
        'real_end_date',
        'status'
    ];

    //Relacionamento: Um vínculo pertence a um Aluno
    public function student(): BelongsTo
    {
        return $this->belongsTo(Student::class, 'student_id');
    }

    // Relacionanto: Um vínculo pertence a uma Empresa
    public function company(): BelongsTo
    {
        return $this->belongsTo(Company::class, 'company_id');
    }
}
