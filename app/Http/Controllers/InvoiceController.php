<?php

namespace App\Http\Controllers;

use App\Models\Invoice;
use App\Models\Keranjang;
use App\Models\product;
use Illuminate\Http\Request;
use PHPUnit\Framework\MockObject\Stub\ReturnCallback;

class InvoiceController extends Controller
{
    public function createInvoice(){
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

        return view('invoice', compact('checkout','keranjang','products'));
    }

    function updateJumlah($id, Request $request){
        $request->validate([
            'Jumlah'=>['required','numeric']
        ]);

        $keranjang = Keranjang::find($id);

        $productx = product::find($keranjang->ProductId);
    
        Keranjang::find($id)->update([
            'Jumlah'=>$request->Jumlah,
            'Subtotal'=>$request->Jumlah*$productx->Harga
        ]);

        return back();
    }

    public function createInvoice1(Request $request){
        $request->validate([
            'Alamat' => ['required', 'string','min:10', 'max:100'],
            'KodePos' => ['required', 'max:5', 'min:5'],
        ]);
     
        Invoice::create([
            'InvoiceNum'=>mt_rand(1000, 9999),
            'Alamat'=>$request->Alamat,
            'KodePos'=>$request->KodePos,
            'Total'=>0
        ]);
        return back();
    }

}
