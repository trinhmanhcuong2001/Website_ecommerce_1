<?php

namespace App\Http\Services\Product;
use App\Models\Menu;
use App\Models\Product;

class ProductService {
    //ADMIN
    public function getMenu(){
        return Menu::where('active', 1)->get();
    }

    public function isValidPrice($request){
        if($request->input('price') != 0 && $request->input('price_sale') != 0 && $request->input('price_sale') >= $request->input('price')){
            session()->flash('error', 'Giá giảm phải nhỏ hơn giá gốc');
            return false;
        }
        if($request->input('price_sale') != 0 && $request->input('price') == 0){
            session()->flash('error', 'Vui lòng nhập giá gốc');
            return false;
        }
        return true;
    }

    public function insert($request){
        $isValidPrice = $this->isValidPrice($request);
        if($isValidPrice == false) return false;

        try {
            $request->except('_token');
            Product::create($request->all());
            session()->flash('success','Thêm sản phẩm thành công');
        } catch (\Exception $err) {
            session()->flash('error', $err->getMessage());
            return false;
        }
        return true;    
        
    }
    public function get(){
        return Product::with('menu')->orderBy('id')->paginate(15); 
    }
    public function update($request, $product){
        $isValidPrice = $this->isValidPrice($request);
        if($isValidPrice == false) return false;

        try {
            $product->fill($request->input());
            $product->save();
            session()->flash('success', 'Cập nhật thành công');
        } catch(\Exception $e)
        {
            session()->flash('error', $err->getMessage());
            return false;
        }
        return true;
    }
    public function delete($request){
        $product = Product::where('id', $request->input('id'))->first();
        if($product){
            $product->delete();
            return true;
        }
        return false;
    }
    //HOME
    public function show(){
        return Product::select('id','name','price','price_sale','thumb')->orderBy('id')->limit(16)->get(); 
    }
    public function getProduct($page = null){
        $totalPage = Product::count();
        $isLastPage = false;
        if(($page+1) * 16 > $totalPage){
            $isLastPage = true;
        }
        $products = Product::select('id','name','price','price_sale','thumb')->orderBy('id')
        ->when($page != null, function($query) use ($page) {
            $query->offset($page * 16);
        })
        ->limit(16)->get();
        return [
            'products' => $products,
            'isLastPage' => $isLastPage,
        ];
    }
    public function showProductDetails($product_id){
        return Product::find($product_id);
    }
    public function showId($id){
        return Product::where('id', $id)->where('active', 1)->with('menu')->firstOrFail();
    }
    public function relateProducts($id){
        $menu_id = Product::where('id', $id)->value('menu_id');
        return Product::select('id','name','price','price_sale','thumb')->where('active', 1)
        ->where('menu_id', $menu_id)->where('id','!=', $id)->orderByDesc('id')->limit(8)->get();
        //Cách  thêm truy vấn con
        // return Product::select('id','name','price','price_sale','thumb')->where('active', 1)
        // ->where('menu_id', function ($query) use ($id) {
        //     $query->select('menu_id')->from('products')->where('id', $id);
        // })
        // ->where('id','!=', $id)->orderByDesc('id')->limit(8)->get();
    }
}