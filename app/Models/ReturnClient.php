<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReturnClient extends Model
{
    use HasFactory;

    public function returnItem()
    {
        return $this->hasMany(ReturnFormParties::class);
    }

    public function client()
    {
        return $this->belongsTo(Client::class);
    }
    
    public function sale()
    {
        return $this->belongsTo(Sale::class);
    }

}
