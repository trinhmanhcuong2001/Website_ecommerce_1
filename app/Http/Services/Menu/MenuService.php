<?php


namespace App\Http\Services\Menu;
use App\Models\Menu;
use Str;
use Session;


class MenuService {

    public function getParent(){
        return Menu::where('parent_id', 0)->get();
    }
    public function getAll(){
        return Menu::orderBy('id')->paginate(20);
    }

    public function create($request){
        try {
            Menu::create([
                'name' => (string) $request->input('name'),
                'parent_id' => (int) $request->input('parent_id'),
                'description' => (string) $request->input('description'),
                'content' => (string) $request->input('content'),
                'active' => (int) $request->input('active'),
                'slug' => Str::slug($request->input('name'), '-')
            ]);
            Session::flash('success','Tạo Danh Mục Thành Công');
        } catch (\Exception $err){
            Session::flash('error', $err->getMessage());
            return false;
        }
        return true;
    }
    public function update($menu, $request)
    {
        try {
            if($request->input('parent_id') != $menu->id){
                $menu->parent_id = (int) $request->input('parent_id');
            }

            $menu->name = (string) $request->input('name');
            $menu->description = (string) $request->input('description');
            $menu->content = (string) $request->input('content');
            $menu->active = (int) $request->input('active');
            $menu->slug = Str::slug($request->input('name'), '-');
            $menu->save();  
            Session::flash('success','Cập nhật danh mục thành công');
        } catch (\Exception $err){
            Session::flash('error', $err->getMessage());
            return false;
        }
        return true;
    }
    public function delete($request){
        $id = (int) $request->input('id');
        $name = (string) $request->input('name');
        $menu = Menu::where('id', $id)->first();
        if($menu){
            return Menu::where('id', $id)->orWhere('parent_id', $id)->delete();
        }
        return false;
    }
    public function show(){
        return Menu::select('id', 'name')->where('parent_id', 0)->orderBy('id')->get();
    }
    public function getId($id){
        return Menu::where('id', $id)->where('active', 1)->firstOrFail();
    }
    public function getProduct($menu, $request){
        $query = $menu->product()->select('id', 'name', 'price', 'price_sale', 'thumb')->where('active', 1);

        if($request->input('price')){
            $query->orderBy('price', $request->input('price'));
        }
        return $query->paginate(12)->withQueryString();
    }
}
