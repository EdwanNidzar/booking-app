<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Penginapan extends Model
{
    use HasFactory;

    protected $fillable = [
        'host_id',
        'nama_penginapan',
        'location',
        'photo',
        'price',
        'status',
    ];

    public function host()
    {
        return $this->belongsTo(User::class, 'host_id');
    }

    public function properties()
    {
        return $this->hasMany(Propertie::class, 'penginapan_id');
    }
}
