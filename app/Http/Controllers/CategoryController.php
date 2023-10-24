<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Config;
use Validator;

class CategoryController extends Controller
{
    var $rp = 10;
    public function index(){
        $category = Category::paginate($this->rp);
        return view('category/index',compact('category',$category));
    }
    public function search(Request $request){
        $query = $request->q;
        if($query){
            $category = Category::where('name','like','%'.$query.'%')->paginate($this->rp);
        }
        else{
            $category = Category::paginate($this->rp);
        }
        return view('category/index', compact('category',$category));
    }
    public function __construct()
    {
        $this->rp = Config::get('app.result_per_page'); 
    }
    public function edit($id = null){
        if($id){
        $category = Category::find($id);
        return view('category/edit')->with('category',$category);
        }else{
            return view('category/add');
        }
    }
    public function update(Request $request) {
        $rules = array(
            'name' => 'required',
        );
        
        $messages = array(
            'required' => 'กรุณากรอกข้อมูล :attribute ให้ครบถ้วน', 
        );
        
        $id = $request->id;
        $temp = array(
            'name' => $request->name,
        );
        
        $validator = Validator::make($temp, $rules, $messages);
        if ($validator->fails()) {
            return redirect('category/edit/'.$id)
                ->withErrors($validator)
                ->withInput();
        }
        $category = Category::find($id);
        $category->name = $request->name;
        $category->save(); 

        return redirect('category')
        ->with('ok', true)
        ->with('msg', 'บันทึกขอมูลเรียบร้อยแล้ว');
    
    }
    public function insert(Request $request){
        $rules = array(
            'name' => 'required', 
        );
        
        $messages = array(
            'required' => 'กรุณากรอกข้อมูล :attribute ให้ครบถ้วน', 
            'numeric' => 'กรุณากรอกข้อมูล :attribute ให้เป็นตัวเลข',
        );
        $temp = array(
            'name' => $request->name,
        );
        
        $validator = Validator::make($temp, $rules, $messages);
        if ($validator->fails()) {
            return redirect('category/edit')
                ->withErrors($validator)
                ->withInput();
        }
        $category = new Category();
        $category->name = $request->name; 
        $category->save();

        return redirect('category')
        ->with('ok', true)
        ->with('msg', 'บันทึกขอมูลเรียบร้อยแล้ว');
    }
    public function remove($id){
        Category::find($id)->delete();
        return redirect('category')->with('ok',true)->with('msg','ลบข้อมูลสำเร็จ');
  }
}
