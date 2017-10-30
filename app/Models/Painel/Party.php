<?php

namespace App\Models\Painel;

use Illuminate\Database\Eloquent\Model;

class Party extends Model
{
    protected $table = 'parties';
    
    protected $fillable = [
        'name', 'initials', 'active'
    ];
}
