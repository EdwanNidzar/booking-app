<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Aula extends Model
{
    use HasFactory;

    protected $fillable = [
        'host_id',
        'nama_aula',
        'location',
        'photo',
        'price',
        'status',
    ];

    public function host()
    {
        return $this->belongsTo(User::class, 'host_id');
    }
}
