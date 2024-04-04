<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Noctice extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'detail',
    ];

    public function nocticeDetails()
    {
        return $this->hasMany(NocticeDetail::class);
    }

}
