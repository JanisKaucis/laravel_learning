<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CovidData extends Model
{
    use HasFactory;
    protected $fillable = [
        '_id', 'Datums', 'AdministrativiTeritorialasVienibasNosaukums',
        'ATVK','ApstiprinataCOVID19infekcija','AktivaCOVID19infekcija',
        '14DienuKumulativaSaslimstiba'
    ];
}
