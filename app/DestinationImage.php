<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DestinationImage extends Model
{
    use HasFactory;

    protected $fillable = ['image', 'is_primary'];

    protected $casts = [
        'is_primary' => 'boolean',
    ];

    public function destination()
    {
        return $this->belongsTo(Destinations::class, 'destination_id');
    }
}
