<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    function createProduct(){
        $categories = Category::all();
        
        return view('addProduct', compact('categories'));
    }

    function createProduct1(Request $request){
        $request->validate([
            'CategoryId'=>['required'],
            'Nama'=>['required', 'string', 'min:5', 'max:80'],
            'Harga'=>['required', 'numeric'],
            'Jumlah'=>['required','numeric'],
            'Photo'=>['required','image']
        ]);
        
        $now = now()->format('Y-m-d_H.i.s');
        $filename = $now.'_'.$request->file('Photo')->getClientOriginalName();
        $request->file('Photo')->storeAs('/public'.'/'.$filename);

        product::create([
            'CategoryId'=>$request->CategoryId,
            'Nama'=>$request->Nama,
            'Harga'=>$request->Harga,
            'Jumlah'=>$request->Jumlah,
            'Photo'=>$filename,
        ]);

        return redirect('/');
    }

    public function viewProduct(){
        $products = product::all();
        $categories = Category::all();

        $categoryStat = [];
        foreach ($categories as $category) {
            $categoryStat[$category->id] = false;
        }
    
        foreach ($products as $product) {
            $categoryStat[$product->CategoryId] = true;
        }

        return view('home', compact('products', 'categories', 'categoryStat'));
    }

    public function editProduct($id){
        $prod = product::findOrFail($id);
        $categories = Category::all();
        return view('edit', compact('prod', 'categories'));
    }

    public function updateProduct($id, Request $request){
        $request->validate([
            'CategoryId'=>['required'],
            'Nama'=>['required', 'string', 'min:5', 'max:80'],
            'Harga'=>['required', 'numeric'],
            'Jumlah'=>['required','numeric'],
            'Photo'=>['required','image']
        ]);

        Storage::delete('/public'.'/'.product::find($id)->Photo);
        $now = now()->format('Y-m-d_H.i.s');
        $filename = $now.'_'.$request->file('Photo')->getClientOriginalName();
        $request->file('Photo')->storeAs('/public'.'/'.$filename);

        product::find($id)->update([
            'CategoryId'=>$request->CategoryId,
            'Nama'=>$request->Nama,
            'Harga'=>$request->Harga,
            'Jumlah'=>$request->Jumlah,
            'Photo'=>$filename,
        ]);

        return redirect('/');
    }

    public function deleteProduct($id){
        $productdelete= product::find($id);
        product::destroy($id);
        Storage::delete('/public'.'/'.$productdelete->Photo);
        return redirect('/');
    }
}
