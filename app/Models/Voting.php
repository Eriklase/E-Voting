<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Voting extends Model
{
    use HasFactory;

    protected $table = 'voting';

    protected $fillable = ['mahasiswa_id', 'kandidat_id'];

    /**
     * Get the mahasiswa that owns this voting.
     */
    public function mahasiswa()
    {
        return $this->belongsTo(Mahasiswa::class);
    }

    /**
     * Get the kandidat that is voted.
     */
    public function kandidat()
    {
        return $this->belongsTo(Kandidat::class);
    }
}
