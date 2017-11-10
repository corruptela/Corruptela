<?php

namespace App\Models\Painel;

use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
    protected $table = 'countries';
    
    protected $fillable = [
        'name', 'initials', 'oficialid'
    ];
    
    public function federativeUnits()
    {
        return $this->hasMany(FederativeUnit::class);
    }
    
    
}
