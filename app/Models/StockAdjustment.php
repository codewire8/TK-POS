<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StockAdjustment extends Model
{
    use HasFactory;

    protected $fillable = [
        'refno',
        'qty',
        'action',
        'remarks',
        'adjustment_date',
        'flavor_id',
        'user'
    ];

    public function product()
    {
        return $this->hasMany(Flavor::class);
    }
}
