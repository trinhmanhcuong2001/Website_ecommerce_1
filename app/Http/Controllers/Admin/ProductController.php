<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\Product\ProductRequest;
use App\Http\Services\Product\ProductService;
use App\Models\Product;

class ProductController extends Controller
{

    protected $productService;
    public function __construct(ProductService $productService){
        $this->productService = $productService;
    }

    public function index()
    {
        return view('admin.product.list',[
            'title' => 'Danh sách sản phẩm',
            'products' => $this->productService->get()
        ]);
    }

    public function create()
    {
        return view('admin.product.add',[
            'title' => 'Thêm sản phẩm',
            'menus' => $this->productService->getMenu()
        ]);
    }

    public function store(ProductRequest $request)
    {
        $this->productService->insert($request);
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        return view('admin.product.edit',[
            'title' => 'Chỉnh sửa sản phẩm ',
            'product' => $product,
            'menus' => $this->productService->getMenu(),
            'url' => url($product->url)
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Product $product)
    {
       $result = $this->productService->update($request, $product);
       if($result) return \redirect('/admin/product/list');
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function delete(Request $request)
    {
        $result = $this->productService->delete($request);
        if($result){
            return response()->json([
                'error' => false,
                'message' => 'Xóa thành công'
            ]);
        }
        return response()->json([
            'error' => true
        ]);
    }
}
