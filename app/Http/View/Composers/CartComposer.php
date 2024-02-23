<?php

namespace App\Http\View\Composers;
use App\Models\Product;
use Illuminate\View\View;

class CartComposer 
{

    public function __construct(){

    }

    public function compose(View $view){
        $carts = session()->get('carts',[]);
        $productId = array_keys($carts);
        $products = Product::select('id','name', 'price_sale', 'price','thumb')
        ->where('active',1)->whereIn('id', $productId)->orderByDesc('id')->get();
        $view->with('carts',$products);
    }
}