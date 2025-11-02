<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pet extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'name',
        'type',
        'birth_date',
        'photo',
        'notes'
    ];

    protected $casts = [
        'birth_date' => 'date',
    ];

    // Relationship: Pet belongs to User
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Relationship: Pet has many CareLog
    public function careLogs()
    {
        return $this->hasMany(CareLog::class);
    }
}