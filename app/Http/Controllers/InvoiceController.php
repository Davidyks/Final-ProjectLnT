<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Invoice;
use App\Models\Keranjang;
use App\Models\product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use PHPUnit\Framework\MockObject\Stub\ReturnCallback;

class InvoiceController extends Controller
{
    public function createInvoice(){
        $keranjang = Keranjang::all();
        $products = [];
        $checkout = true;
        $categories = Category::all();
        $total = 0;

        foreach($keranjang as $k){
            if($k->Status != 'done' && $k->UserId == Auth::user()->id){
                $checkout = false;
                $total += $k->Subtotal;
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

        return view('invoice', compact('checkout','keranjang','products','categories','total','categoryStat'));
    }

    function updateJumlah($id, Request $request){
        $keranjang = Keranjang::find($id);
        $productx = product::find($keranjang->ProductId);

        $request->validate([
            'Jumlah'=>['required','integer','min:1', 'max:'. $productx->Jumlah]
        ]);
    
        Keranjang::find($id)->update([
            'Jumlah'=>$request->Jumlah,
            'Subtotal'=>$productx->Harga*$request->Jumlah
        ]);

        return back();
    }

    function changeStatus(){
        $keranjang = Keranjang::all();
        $keranjangID = [];

        foreach($keranjang as $k){
            if($k->Status != 'done' && $k->UserId == Auth::user()->id){
                $keranjangID[] = $k->id;
            }
        }
        
        // $keranjangIDLength = count($keranjangID);
        // for ($i = 0; $i < $keranjangIDLength; $i++) {
        //     Keranjang::find($keranjangID[$i])->update([
        //         'Status'=>'done'
        //     ]);

        //     $productx = product::find($keranjangID[$i]->ProductId);

        //     product::find($keranjangID[$i]->ProductId)->update([
        //         'Jumlah'=>$productx->Jumlah - $keranjangID[$i]->Jumlah
        //     ]);
        // }

        foreach ($keranjangID as $id) {  
            $keranjang = Keranjang::find($id);

            Keranjang::find($id)->update([
                'Status' => 'done'
            ]);

            $productx = product::find($keranjang->ProductId);
    
            product::find($keranjang->ProductId)->update([
                'Jumlah' => $productx->Jumlah - $keranjang->Jumlah
            ]);
        }

        return redirect('/');
    }

    public function deleteKeranjang($id){
        Keranjang::destroy($id);
        return redirect('/keranjang');
    }

    public function createInvoice1(Request $request){
        $request->validate([
            'Alamat' => ['required', 'string','min:10', 'max:100'],
            'KodePos' => ['required', 'max:5', 'min:5'],
        ]);

        $keranjang = Keranjang::all();
        $total = 0;

        foreach($keranjang as $k){
            if($k->Status != 'done' && $k->UserId == Auth::user()->id){
                $total += $k->Subtotal;
            }
        }
     
        $invoice = Invoice::create([
            'InvoiceNum'=>mt_rand(1000, 9999),
            'Alamat'=>$request->Alamat,
            'KodePos'=>$request->KodePos,
            'Total'=>$total
        ]);
        
        return redirect('/invoiceTotal'.'/'.$invoice->id);
    }

    public function viewInvoice($id){
        $keranjang = Keranjang::all();
        $products = [];
        $checkout = true;
        $categories = Category::all();
        $total = 0;
        $invoice = Invoice::find($id);

        foreach($keranjang as $k){
            if($k->Status != 'done' && $k->UserId == Auth::user()->id){
                $checkout = false;
                $total += $k->Subtotal;
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

        return view('invoiceTotal', compact('checkout','keranjang','products','categories','total','invoice','categoryStat'));
    }

}
