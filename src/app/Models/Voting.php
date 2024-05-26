<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Voting extends Model
{
    use HasFactory;

    protected $fillable = [
        'pin_id',
        'option',
    ];

    protected $table = 'voting';

    public function pin()
    {
        return $this->belongsTo(Pin::class);
    }

    public const CANDIDATE = [
        1 => [
            'name' => 'COOL B2B (GC : Lim Sui Djaja)',
            'image' => 'cool-b2b.jpg',
        ],
        2 => [
            'name' => 'COOL Citra 2 (GC : Andre Tjahjanto)',
            'image' => 'cool-citra-2.jpg',
        ],
        3 => [
            'name' => 'COOL Citra 5 (GC : Rahmat Bezaliel)',
            'image' => 'cool-citra-5.jpg',
        ],
        4 => [
            'name' => 'COOL Efata (GC : Kencana Albert)',
            'image' => 'cool-efata.jpg',
        ],
        5 => [
            'name' => 'COOL Sandi Cintia (GC : Sandi Cintia)',
            'image' => 'cool-sandi-cintia.jpg',
        ]
    ];

}
