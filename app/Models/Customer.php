<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Customer extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'email',
        'gender',
        'birthdate',
    ];

    public function cars(): BelongsToMany
    {
        return $this->belongsToMany(Car::class);
    }
}
