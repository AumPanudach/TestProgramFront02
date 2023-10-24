<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Config;
use Validator;

class ProductController extends Controller
{   

    var $rp = 2;
    public function index(){
        $products = Product::paginate($this->rp);
        return view('product/index',compact('products'));
    }
    public function search(Request $request){
        $query = $request->q;
        if($query){
            $products = Product::where('name','like','%'.$query.'%')->orWhere('code','like','%'.$query.'%')->paginate($this->rp);
        }
        else{
            $products = Product::paginate($this->rp);
        }
        return view('product/index', compact('products'));
    }
    public function __construct()
    {
        $this->rp = Config::get('app.result_per_page'); 
    }
    public function edit($id = null){
        $categories = Category::pluck('name','id')->prepend('select',);
        if($id){
             $product = Product::where('id',$id)->first();
             return view('product/edit')->with('product',$product)->with('categories',$categories);
        }
        else{
           return view('product/add')->with('categories',$categories);
        }
    }
    public function update(Request $request) {
        $num = $request->category_id;
        if($num == 0){
            $num = null;
        }
        $rules = array(
            'code' => 'required', 
            'name' => 'required',
            'category_id' => 'required|numeric', 
            'price' => 'numeric',
            'stock_qty' => 'numeric',
        );
        
        $messages = array(
            'required' => 'กรุณากรอกข้อมูล :attribute ให้ครบถ้วน', 
            'numeric' => 'กรุณากรอกข้อมูล :attribute ให้เป็นตัวเลข',
        );
        
        $id = $request->id;
        $temp = array(
            'code' => $request->code,
            'name' => $request->name,
            'category_id' => $num,
            'price' => $request->price,
            'stock_qty' => $request->stock_qty,
        );
        
        $validator = Validator::make($temp, $rules, $messages);
        if ($validator->fails()) {
            return redirect('product/edit/'.$id)
                ->withErrors($validator)
                ->withInput();
        }
        $product = Product::find($id);
        $product->code = $request->code;
        $product->name = $request->name;
        $product->category_id = $request->category_id;
        $product->price = $request->price;
        $product->stock_qty = $request->stock_qty;

        $product->save(); 

        if($request->hasFile('image')){
            $f = $request->file('image');
            $upload_to = 'upload/image';
            $relative_path = $upload_to.'/'.$f->getClientOriginalName();
            $absolute_path = public_path().'/'.$upload_to;
            $f->move($absolute_path,$f->getClientOriginalName());
            $product->image_url = $relative_path;
            $product->save();        }
        
        return redirect('product')
        ->with('ok', true)
        ->with('msg', 'บันทึกขอมูลเรียบร้อยแลว้');
    }
    public function insert(Request $request){
        $num = $request->category_id;
        if($num == 0){
            $num = null;
        }
        $rules = array(
            'code' => 'required', 
            'name' => 'required',
            'category_id' => 'required|numeric', 
            'price' => 'numeric',
            'stock_qty' => 'numeric',
        );
        
        $messages = array(
            'required' => 'กรุณากรอกข้อมูล :attribute ให้ครบถ้วน', 
            'numeric' => 'กรุณากรอกข้อมูล :attribute ให้เป็นตัวเลข',
        );
        $temp = array(
            'code' => $request->code,
            'name' => $request->name,
            'category_id' => $num,
            'price' => $request->price,
            'stock_qty' => $request->stock_qty,
        );
        
        $validator = Validator::make($temp, $rules, $messages);
        if ($validator->fails()) {
            return redirect('product/edit')
                ->withErrors($validator)
                ->withInput();
        }
        $product = new Product();
        $product->code = $request->code; 
        $product->name = $request->name; 
        $product->category_id = $request->category_id; 
        $product->price = $request->price; 
        $product->stock_qty = $request->stock_qty; 
        $product->save();
        if($request->hasFile('image')){
            $f = $request->file('image');
            $upload_to = 'upload/image';
            $relative_path = $upload_to.'/'.$f->getClientOriginalName();
            $absolute_path = public_path().'/'.$upload_to;
            $f->move($absolute_path,$f->getClientOriginalName());
            $product->image_url = $relative_path;
            $product->save();
        } 
        return redirect('product')
        ->with('ok', true)
        ->with('msg', 'บันทึกขอมูลเรียบร้อยแลว้');
    }
    public function remove($id){
          Product::find($id)->delete();
          return redirect('product')->with('ok',true)->with('msg','ลบข้อมูลสำเร็จ');
    }
}
