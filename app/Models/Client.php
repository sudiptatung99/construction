<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'email',
        'number',
        'address',
        'pin',
    ];

    public function sale()
    {
        return $this->hasMany(Sale::class);
    }
    public function reciver()
    {
        return $this->hasMany(ReciveAmount::class);
    }
      public function returnClient()
    {
        return $this->hasMany(ReturnClient::class);
    }
}
