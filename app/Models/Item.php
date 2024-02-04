<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'unit_id',
        'category_id',
        'image',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function unit()
    {
        return $this->belongsTo(Unit::class);
    }

   
    public function purchaseitem()
    {
        return $this->hasMany(PurchaseItem::class);
    }
    public function saleitem()
    {
        return $this->hasMany(SaleItem::class);
    }
    public function return()
    {
        return $this->hasMany(ReturnFormParties::class);
    }
}
