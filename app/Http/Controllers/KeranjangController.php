<?php

namespace App\Http\Controllers;

use App\Models\Keranjang;
use App\Models\product;
use Illuminate\Http\Request;

class KeranjangController extends Controller
{

    public function editKeranjang($id){
        Keranjang::create([
            'ProductId'=>$id,
            'Status'=>"Belum Checkout",
            'Jumlah'=>0,
            'Subtotal'=>0
        ]);

        return redirect('/');
    }    
    public function viewKeranjang(){
        $keranjang = Keranjang::all();
        $products = [];
        $checkout = true;

        foreach($keranjang as $k){
            if($k->Status != 'done'){
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

        return view('keranjang', compact('checkout','keranjang','products'));
    }

}
