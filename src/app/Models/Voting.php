<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Voting extends Model
{
    use SoftDeletes;
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
            'image' => 'COOL_B2B.webp',
        ],
        2 => [
            'name' => 'COOL Citra 2 (GC : Andre Tjahjanto)',
            'image' => 'COOL_Citra_2.webp',
        ],
        3 => [
            'name' => 'COOL Citra 5 (GC : Rahmat Bezaliel)',
            'image' => 'COOL_Citra_5.webp',
        ],
        4 => [
            'name' => 'COOL Efata (GC : Kencana Albert)',
            'image' => 'COOL_Efata.webp',
        ],
        5 => [
            'name' => 'COOL Sandi Cintia (GC : Sandi Cintia)',
            'image' => 'COOL_Sandi_Cintia.webp',
        ]
    ];

}
