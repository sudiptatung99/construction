<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Expense extends Model
{
    use HasFactory;
    protected $fillable = [
        'expense',
        'amount',
        'pay_mode',
        'pay_status',
        'details',
        'date',
        'image',
    ];
}
