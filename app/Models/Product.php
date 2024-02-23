<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use App\Models\Menu;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'content',
        'menu_id',
        'price',
        'price_sale',
        'active',
        'thumb'
    ];

    public function menu(): hasOne{
        return $this->hasOne(Menu::class, 'id', 'menu_id')->withDefault(['name' => '']);
    }
    public function comment(): hasOne{
        return $this->hasOne(Comment::class, 'product_id', 'id');
    }
}
