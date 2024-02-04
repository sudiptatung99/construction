<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReturnFormParties extends Model
{
    use HasFactory;

    protected $fillable = [
        'client_id',
        'item_id',
        'qty',
        'date',
        'amount',
        'amount'
    ];

    
    public function item()
    {
        return $this->belongsTo(Item::class);
    }
    public function returnClient()
    {
        return $this->belongsTo(ReturnClient::class);
    }
}
