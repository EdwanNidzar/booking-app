<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Propertie extends Model
{
    use HasFactory;

    protected $table = 'properties';

    protected $fillable = [
        'penginapan_id',
        'type',
        'beds',
        'bathrooms',
        'facilities',
        'max_guest',
    ];

    public function penginapan()
    {
        return $this->belongsTo(Penginapan::class, 'penginapan_id');
    }
}
