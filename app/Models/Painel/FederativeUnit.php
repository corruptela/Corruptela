<?php
namespace App\Models\Painel;

use Illuminate\Database\Eloquent\Model;

class FederativeUnit extends Model
{

    protected $fillable = [
        'name',
        'initials',
        'active',
        'oficialid'
    ];

    public function country()
    {
        return $this->belongsTo(Country::class);
    }
}
