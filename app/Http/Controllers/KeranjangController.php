<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Keranjang;
use App\Models\product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class KeranjangController extends Controller
{

    public function editKeranjang($id){

        $productx = product::find($id);
        $already = false;
        $keranjang = Keranjang::all();

        foreach($keranjang as $k){
            if($k->ProductId == $productx->id && $k->Status != 'done' && $k->UserId == Auth::user()->id){
                $already = true;
            }
        }

        if($already == false){
            Keranjang::create([
                'UserId'=>Auth::user()->id,
                'ProductId'=>$id,
                'Status'=>"Belum Checkout",
                'Jumlah'=>1,
                'Subtotal'=>$productx->Harga
            ]);
        }

        return redirect('/');
    }    
    public function viewKeranjang(){
        $keranjang = Keranjang::all();
        $products = [];
        $checkout = true;
        $categories = Category::all();

        foreach($keranjang as $k){
            if($k->Status != 'done' && $k->UserId == Auth::user()->id){
                $checkout = false;
                break;
            }
        }

        foreach ($keranjang as $k) {
            $product = product::find($k->ProductId);
            
            if ($product) {
                $products[] = $product;
            }
        }

        $categoryStat = [];
        foreach ($categories as $category) {
            $categoryStat[$category->id] = false;
        }
    
        foreach ($keranjang as $k) {
            $productx = product::find($k->ProductId);
            if($k->Status !== 'done' && $k->UserId == Auth::user()->id){
                $categoryStat[$productx->CategoryId] = true;
            }
        }

        return view('keranjang', compact('checkout','keranjang','products','categories','categoryStat'));
    }

}
