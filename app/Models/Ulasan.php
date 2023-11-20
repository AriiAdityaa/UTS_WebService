<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Ulasan extends Model
{
    protected $fillable = [
        'merk', 'nama_pengulas','rating','ulasan'
    ];
}
