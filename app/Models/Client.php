<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'nom',
        'prenom',
        'tel1',
        'tel2',
        'email',
        'address1',
        'addresse2',
        'id_client',
    ];
}
