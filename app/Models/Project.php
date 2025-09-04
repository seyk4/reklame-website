<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Project extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama_proyek',
        'deskripsi',
        'status',
        'client_id',
        'latitude',
        'longitude',
    ];

    // Mendefinisikan bahwa sebuah Proyek "milik" satu Klien
    public function client()
    {
        return $this->belongsTo(Client::class);
    }

}
