<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Client extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama_klien',
        'kontak_person',
        'nomor_telepon',
        'alamat',
    ];

    public function projects()
    {
        return $this->hasMany(Project::class);
    }
    
}
