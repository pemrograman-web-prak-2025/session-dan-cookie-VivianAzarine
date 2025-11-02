<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CareLog extends Model
{
    use HasFactory;

    protected $fillable = [
        'pet_id',
        'activity_type',
        'activity_date',
        'description'
    ];

    protected $casts = [
        'activity_date' => 'date',
    ];

    // Relationship: CareLog belongs to Pet
    public function pet()
    {
        return $this->belongsTo(Pet::class);
    }
}