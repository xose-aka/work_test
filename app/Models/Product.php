<?php

namespace App\Models;

use Illuminate\Support\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Product
 * @package App\Models
 * @property Collection $suppliers
 * @property Price $price
 */
class Product extends Model
{
    use HasFactory;

    public function suppliers()
    {
        return $this->belongsToMany(Supplier::class)
                    ->withPivot('code', 'price_dollar', 'price_euro');
    }

    public function cheapest()
    {
        return $this->suppliers()->wherePivot('price_dollar');
    }

    public function price()
    {
        return $this->hasOne(Price::class);
    }
}
