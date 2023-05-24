<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class CarService extends Model
{
    use HasFactory;

    protected $fillable = [
        'service_date',
    ];

    public function services(): BelongsToMany
    {
        return $this->belongsToMany(Car::class);
    }
}
