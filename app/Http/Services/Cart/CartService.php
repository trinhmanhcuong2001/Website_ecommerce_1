<?php 

namespace App\Http\Services\Cart;

use Arr;
use App\Models\Product;
use App\Models\Customer;
use App\Models\Cart;
use DB;
use App\Jobs\SendMail;

class CartService 
{
    public function create($request){
        $qty = (int)$request->input('num_product');
        $product_id = (int)$request->input('product_id');
        
        if($qty <= 0 || $product_id <= 0){
            session()->flash('error', 'Số lượng hoặc sản phẩm không chính xác');
            return false;
        }
        $carts = session()->get('carts');
        if($carts == null){
            session()->put('carts',[
                $product_id => $qty
            ]);
            return true;
        }
        $exists = Arr::exists($carts, $product_id);
        if($exists){
            $carts[$product_id] = $carts[$product_id] + $qty;
            session()->put('carts', $carts);
            return true;
        }
        $carts[$product_id] = $qty;
        session()->put('carts',$carts);
        return true;


        // if (array_key_exists($product_id, $carts)) {
        //     $carts[$product_id] += $qty;
        // } else {
        //     $carts[$product_id] = $qty;
        // }
    
        // session()->put('carts', $carts);
    
        // return true;
    }
    public function getProduct(){
        $carts = session()->get('carts');
        if($carts == null) return [];

        $productId = array_keys($carts);
        return Product::select('id','name', 'price','price_sale', 'thumb')->where('active', 1)->whereIn('id', $productId)->get();
    }
    public function update($request){
        session()->put('carts', $request->input('num_product'));
        return true;
    }
    public function delete($id = 0){
        $carts = session()->get('carts');
        unset($carts[$id]);
        session()->put('carts', $carts);
        return true;
    }
    public function addCart($request){
        try{
            DB::beginTransaction();
            $carts = session()->get('carts');
            if($carts == null) return false;
            
            $customer = Customer::create([
                'name' => $request->input('name'),
                'email' => $request->input('email'),
                'phone' => $request->input('phone'),
                'address' => $request->input('address'),
                'content' => $request->input('content')
            ]);

            $this->infoProductCart($carts, $customer->id);
            DB::commit();
            session()->flash('success','Đặt hàng thành công!');
            #Hàng đợi
            //SendMail::dispatch($request->input('email'))->delay(now()->addSeconds(5));
            $cartEmail = $customer->carts()->with('product', function ($query){
                $query->select('id', 'name');
            })->get();
            dispatch(new SendMail($request->input('email'), $cartEmail));

            session()->forget('carts');
        }catch(Exception $err){
            DB::rollback();
            session()->flash('error', $err->getMessage());
            return false;
        }
        return true;
    }
    protected function infoProductCart($carts, $customer_id){
        $productId = array_keys($carts);
        $products = Product::select('id','name', 'price','price_sale', 'thumb')->where('active', 1)->whereIn('id', $productId)->get();

        $data = [];
        foreach ($products as $key => $product) {
            $data[] = [
                'customer_id' =>$customer_id,
                'product_id' =>$product->id,
                'qty' =>$carts[$product->id],
                'price' => $product->price_sale != 0 ? $product->price_sale : $product->price,
            ];
        }
        return Cart::insert($data);
    }
    public function getCustomer(){
        return Customer::paginate(15);
    }
    public function getProductForCart($customer){
        //Lấy tất cả các trường kể cả product
        // return $customer->carts()->get();
        return $customer->carts()->with('product', function ($query){
            $query->select('id','name', 'thumb');
        })->get();
    }
}