<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductAttribute extends Model
{
    use HasFactory;

    protected $table = 'product_attribute';
    protected $primaryKey = 'id_product_attribute';

    protected $fillable = [
        'id_attribute',
        'id_product',
        'id_attribute_value',
    ];
}
