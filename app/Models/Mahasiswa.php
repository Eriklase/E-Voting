<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mahasiswa extends Model
{
    use HasFactory;

    protected $table = 'mahasiswa';

    protected $fillable = ['nim', 'nama', 'jurusan', 'angkatan', 'user_id'];

    /**
     * Get the user that owns this mahasiswa.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the voting record for this mahasiswa.
     */
    public function voting()
    {
        return $this->hasOne(Voting::class);
    }

    /**
     * Check if mahasiswa has voted.
     */
    public function hasVoted()
    {
        return $this->voting()->exists();
    }
}
