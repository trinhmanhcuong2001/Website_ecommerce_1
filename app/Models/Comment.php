<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Product;

class Comment extends Model
{
    use HasFactory;

    protected $fillable = [
        'email',
        'name',
        'content',
        'product_id'
    ];

    public function product(){
        return $this->hasOne(Product::class, 'id', 'product_id');
    }
}
