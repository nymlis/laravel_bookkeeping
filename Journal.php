<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Journal extends Model
{
    use HasFactory;

    protected $fillable = [
        'date',
        'debit_accounts',
        'debit_price',
        'credit_accounts',
        'credit_price',
        'summary',
    ];
}
