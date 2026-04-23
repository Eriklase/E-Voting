<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kandidat extends Model
{
    use HasFactory;

    protected $table = 'kandidat';

    protected $fillable = ['nama_kandidat', 'visi', 'misi', 'foto'];

    /**
     * Get the votes for this kandidat.
     */
    public function voting()
    {
        return $this->hasMany(Voting::class);
    }

    /**
     * Get total votes for this kandidat.
     */
    public function getTotalVotesAttribute()
    {
        return $this->voting()->count();
    }
}
