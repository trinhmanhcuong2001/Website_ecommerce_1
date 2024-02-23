<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Services\Slider\SliderService;
use App\Http\Services\Menu\MenuService;
use App\Http\Services\Product\ProductService;

class HomeController extends Controller
{
    protected $sliderService;
    protected $menuService;
    protected $productService;

    public function __construct(SliderService $sliderService, MenuService $menuService, ProductService $productService){
        $this->sliderService = $sliderService;
        $this->menuService = $menuService;
        $this->productService = $productService;
    }

    public function index(){
        return view('home', [
            'title' => 'Shop bán hàng',
            'sliders' => $this->sliderService->show(),
            'menus' => $this->menuService->show(),
            'products' => $this->productService->show()
        ]);
    }
    public function loadProduct(Request $request){
        $page = $request->input('page');
        $result = $this->productService->getProduct($page);
        
        if(count($result)>0){
            $html = view('products.list', ['products' => $result['products']])->render();
            $isLastPage = $result['isLastPage'];
            return response()->json([
                'html' => $html,
                'isLastPage' => $isLastPage
            ]);
        }
        return response()->json([
            'html' => ''
        ]);
    }
    public function showProductDetails(Request $request){
        $product_id = $request->input('id');
        $result = $this->productService->showProductDetails($product_id);

        $html = view('products.show', ['product' => $result])->render();
        return response()->json([
            'html' => $html
        ]);
    }
}
