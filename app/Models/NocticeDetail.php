<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NocticeDetail extends Model
{
    use HasFactory;

    protected $fillable = [
        'noctice_id',
        'user_id',
    ];

    public function noctices()
    {
        return $this->belongsTo(Noctice::class);
    }
    public function users()
    {
        return $this->belongsTo(User::class);
    }
    
}
