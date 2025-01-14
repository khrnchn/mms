<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;

    protected $fillable = [
        'bill_code',
        'name',
        'email',
        'amount',
        'status',
        'transaction_id',
    ];
}
