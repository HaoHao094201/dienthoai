<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\slider;
use Session;

class SliderController extends Controller
{
    public function slider(Request $request)
    {
        if(!Session::has('TaiKhoan')){
            return redirect('/admin/login');
        }else{
            $item_per_page = $request->has('per_page') ? $request->per_page:10;
            $current_page = $request->has('page') ? $request->page:1;
            $offset = ($current_page - 1) * $item_per_page;
            $slider = slider::limit($item_per_page)->offset($offset)->get();
            $sld =  slider::all();
            $totalPages = ceil(count($sld) / $item_per_page);
            return view('admin.slider.danhsach', compact('slider', 'item_per_page', 'current_page', 'totalPages'));
        }
    }

    public function them()
    {
        if(!Session::has('TaiKhoan')){
            return redirect('/admin/login');
        }else{
            return view('admin.slider.them');
        }
    }
    public function them_db(Request $request)
    {
        $slider = new slider();
        $image = $request->file('img');
        if($image != null) {
            $image_file = $image->getClientOriginalName();
            $image->move('storage/img/banners/',$image_file);
            $slider->img = $image_file;
        }
        else {
            $slider->img = '';
        }
        $slider->save();
        return redirect('/admin/slider')->with('mess', 'Thêm slider thành công!');
    }

    public function sua($id)
    {
        if(!Session::has('TaiKhoan')){
            return redirect('/admin/login');
        }else{
            $slider = slider::findOrFail($id);
            return view('admin.slider.sua', compact('slider'));
        }
    }
    public function sua_db(Request $request, $id)
    {
        $slider = array();
        $image = $request->file('img');
        if($image != null) {
            $image_file = $image->getClientOriginalName();
            $image->move('storage/img/banners/',$image_file);
            $slider['img'] = $image_file;
        }
        else {
            $slider['img'] = '';
        }
        $up = slider::where('idsld', $id)->update($slider);
        return redirect('/admin/slider')->with('mess', 'Cập nhật slider thành công!');
    }

    public function xoa($id)
    {
        if(!Session::has('TaiKhoan')){
            return redirect('/admin/login');
        }else{
            if(isset($_SERVER['HTTP_REFERER'])){
                $slider = slider::findOrFail($id);
                $slider->delete();
                return redirect()->back()->with('mess', 'Xoá slider thành công!');
            }else{
                return abort(404);
            }
        }
    }
}
