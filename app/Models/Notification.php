<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    use HasFactory;

    // Permite que o Laravel insira dados nesses campos via Eloquent
    protected $fillable = [
        'type',
        'title',
        'message',
        'is_read',
    ];
}