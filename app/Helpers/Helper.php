<?php

namespace App\Helpers;
use Str;

class Helper {
    public static function menu($menus, $parent_id = 0, $char = '') : string
    {
        $html = '';
        foreach ($menus as $key => $menu){
            if ($menu->parent_id == $parent_id){
                $html .= '
                    <tr>
                        <td>' . $menu->id . '</td>
                        <td>' . $char . $menu->name . '</td>
                        <td>' . self::active($menu->active) . '</td>
                        <td>' . $menu->updated_at . '</td>
                        <td>
                            <a class="btn btn-primary btn-sm" href="'.url('/admin/menu/edit/'.$menu->id).'" >
                                <i class="fas fa-edit"></i>
                            </a>
                            <a class="btn btn-danger btn-sm" href="#" onclick="removeRow('.$menu->id.',\''.url('/admin/menu/delete/').'\')">
                                <i class="fas fa-trash"></i>
                            </a>
                        </td>
                    </tr>    
                ';
                unset($menus[$key]);

                $html .= self::menu($menus, $menu->id, $char . '--');
            }
        }
        return $html;
    }
    public static function active($active = 0) : string
    {
        return $active == 0 ? '<span class = "btn btn-danger btn-xs">No</span>' : '<span class = "btn btn-success btn-xs">Yes</span>';
    }

    public static function menus($menus, $parent_id=0) : string
    {
        $html = '';
        foreach($menus as $key => $menu){
            if($menu->parent_id == $parent_id){
                $html .= '
                    <li>
                    <a href="'. url('danh-muc/' . $menu->id . '-' . Str::slug($menu->name, '-') . '.html').'">
                    ' . $menu->name . '
                </a>';
                unset($menus[$key]);
                if(self::isChild($menus, $menu->id)){
                    $html .= '<ul class="sub-menu">';
                    $html .= self::menus($menus, $menu->id);
                    $html .= '</ul>';
                }
                $html .= '
                    </li>
                ';
            }
        }
        return $html;
    }
    public static function isChild($menus, $id) : bool
    {
        foreach($menus as $key=>$menu){
            if($menu->parent_id == $id){
                return true;
            }
        }
        return false;
    }
    public static function price($price=0, $priceSale=0){
        if($priceSale !=0 ) return number_format($priceSale) . ' VNĐ';
        if($price != 0 ) return number_format($price) . ' VNĐ';
        return '<a href="/lien-he.html">Liên hệ</a>';
    }
}