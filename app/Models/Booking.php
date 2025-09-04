<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    use HasFactory;

    protected $fillable = [
        'project_id',
        'nama_peminat',
        'email_peminat',
        'telepon_peminat',
        'pesan',
        'status',
    ];

    public function project()
    {
        return $this->belongsTo(Project::class);
    }
}
