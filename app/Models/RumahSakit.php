<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class RumahSakit extends Model
{
    use HasFactory;

    protected $table = 'rumah_sakits';

    protected $fillable = [
        'nama',
        'alamat',
        'email',
        'telepon',
    ];

    /**
     * Get the pasiens for the rumah sakit.
     */
    public function pasiens(): HasMany
    {
        return $this->hasMany(Pasien::class);
    }
}
