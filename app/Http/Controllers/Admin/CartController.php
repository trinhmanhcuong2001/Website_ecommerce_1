<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Services\Cart\CartService;
use App\Models\Customer;

class CartController extends Controller
{
    protected $cartService;
    public function __construct(CartService $cartService){
        $this->cartService = $cartService;
    }

    public function index(){
        return view('admin.carts.customer',[
            'title' => 'Danh sách đơn đặt hàng',
            'customers' => $this->cartService->getCustomer()
        ]);
    }
    public function show(Customer $customer){
        $carts = $this->cartService->getProductForCart($customer);
        return view('admin.carts.detail', [
            'title' => 'Chi tiết đơn hàng: ' .$customer->id,
            'customer' => $customer,
            //Lấy ra tất cả trường kể cả trong product
            //'carts' => $customer->carts()->get(),
            //Chọn ra những trường cần lấy
            'carts' => $carts,
        ]);
    }
}
