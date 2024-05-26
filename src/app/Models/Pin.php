<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pin extends Model
{
    use HasFactory;
    protected $table = 'pin';

    protected $fillable = [
        'name',
        'pin',
        'capacity',
    ];

    public function voting()
    {
        return $this->hasMany(Voting::class);
    }
}
