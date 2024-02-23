<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Services\Slider\SliderService;
use App\Models\Slider;

class SliderController extends Controller
{
    protected $sliderService;
    function __construct(SliderService $sliderService){
        $this->sliderService = $sliderService;
    }
    public function create(){
        return view('admin.slider.add',[
            'title' => 'Thêm Slider'
        ]);
    }
    public function store(Request $request){
        $this->validate($request, [
            'name' => 'required',
            'url' => 'required',
            'thumb' => 'required'
        ]);
        $this->sliderService->insert($request);
        return redirect()->back();
    }
    public function index(){
        return view('admin.slider.list',[
            'title' => 'Danh sách slider',
            'sliders' => $this->sliderService->get()
        ]);
    }
    public function show(Slider $slider){
        return view('admin.slider.edit',[
            'title' => 'Chỉnh sửa slider',
            'slider' => $slider
        ]);
    }
    public function update(Request $request,Slider $slider){
        $this->validate($request, [
            'name' => 'required',
            'url' => 'required',
            'thumb' => 'required'
        ]);
        $result = $this->sliderService->update($request, $slider);
        if($result){
            return redirect('/admin/slider/list');
        }
        return redirect()->back();
    }
    public function delete(Request $request){
        $result = $this->sliderService->delete($request);
        if($result) return response()->json([
            'error' =>false,
            'message' => 'Xóa thành công'
        ]);
        return response()->json(['error' =>true]);
    }
}
