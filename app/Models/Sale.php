<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sale extends Model
{
    use HasFactory;

    public function saleItem()
    {
        return $this->hasMany(SaleItem::class);
    }
    public function return()
    {
        return $this->hasMany(ReturnClient::class);
    }
    public function client()
    {
        return $this->belongsTo(Client::class);
    }
    
}
