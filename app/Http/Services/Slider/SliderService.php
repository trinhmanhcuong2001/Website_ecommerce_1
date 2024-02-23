<?php

namespace App\Http\Services\Slider;
use App\Models\Slider;
use Storage;

class SliderService {
    public function insert($request){

        try 
        {   
            Slider::create($request->input());
            session()->flash('success','Thêm slider thành công');
        }catch (\Exception $e){
            session()->flash('error',$e->getMessage());
            return false;
        }
        return true;
    }
    public function get(){
        return Slider::orderBy('id')->paginate(15);
    }
    public function update($request, $slider){
        try{
            $slider->fill($request->input());
            $slider->save();
            session()->flash('success','Cập nhật slider thành công');
        }catch(Exception $e){
            session()->flash('error', $e->getMessage());
            Log::info($e->getMessage());
            return false;
        }
        return true;
    }
    public function delete($request){
        $slider = Slider::where('id', $request->input('id'))->first();
        if($slider){
            $path = str_replace('storage', 'public', $slider->thumb);
            Storage::delete($path);
            $slider->delete();
            return true;
        }
        return false;
    }

    public function show(){
        return Slider::where('active', 1)->orderBy('sort_by')->get();
    }
}