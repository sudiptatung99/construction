<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Purchase extends Model
{
    use HasFactory;

    public function purchaseitem()
    {
        return $this->hasOne(PurchaseItem::class);
    }
     public function recive()
    {
        return $this->hasMany(VendorPayment::class);
    }

    public function vendor()
    {
        return $this->belongsTo(Vendor::class);
    }
}
