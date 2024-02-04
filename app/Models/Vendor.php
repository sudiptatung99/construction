<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vendor extends Model
{
    use HasFactory;
    // private $guard = ['id'];
    protected $fillable = [
        'name',
        'email',
        'first_number',
        'second_number',
        'address',
        'pin',
    ];

    public function purchase()
    {
        return $this->hasMany(Purchase::class);
    }
}
