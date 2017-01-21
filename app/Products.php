<?php
namespace App;

use Illuminate\Database\Eloquent\Model;

class Products extends Model
{
    protected $table = 'products';

    protected $fillable = [
        'product_code', 'product_name', 'quantity', 'selling_price',
    ];
}