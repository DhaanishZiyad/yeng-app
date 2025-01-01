<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'products';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'price',
        'quantity',
        'description',
        'image_path',
    ];

    /**
     * Additional configuration for model behavior.
     *
     * @var array
     */
    protected $casts = [
        'price' => 'decimal:2',
    ];
}
